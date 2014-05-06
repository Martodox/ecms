<?php

class Model
{

    public $siteTitle;
    public $template;
    public $displayTemplate;
    private $extraCSS;
    private $extraJS;

    public function __construct()
    {
        $this->extraCSS = array();
        $this->extraJS = array();
        $this->displayTemplate = true;
        $this->template = substr(get_class($this), 0, -5);
        if (empty($_SESSION['user'])) {
            $_SESSION['user']['logged'] = false;
            $_SESSION['user']['level'] = 0;
        }

        if (empty($_SESSION['formValidate']['new'])) {
            $_SESSION['formValidate']['new'] = Help::uniqueId();
        }

        $_SESSION['formValidate']['old'] = $_SESSION['formValidate']['new'];
        $_SESSION['formValidate']['new'] = Help::uniqueId();


        $this->siteTitle = serviceName;
        $pacage = APP::route()->getGlobalRewrite();
        $pacage = $pacage['pacage'];
        $component = APP::route()->getGlobalRewrite();
        $component = $component['component'];

        APP::smarty()->
                setTemplateDir(array(
                    'root' => ABSPATH . 'app/templates/',
                    ABSPATH . "app/templates/$pacage",
                    'comp' => ABSPATH . "app/templates/$pacage/$component"
                ))->
                setCompileDir(ABSPATH . 'storage/smarty/compile')->
                setCacheDir(ABSPATH . 'storage/smarty/cache')->
                assign("rootpatch", rootpatch, true)->
                assign("temproot", rootpatch . 'app/templates/', true)->
                assign('comproot', rootpatch . "app/templates/$pacage/$component/", true)->
                assign('packroot', rootpatch . "app/templates/$pacage/", true)->
                assign('siteTitle', $this->siteTitle)->
                assign('isLogin', $_SESSION['user']['logged'], true)->
                assign('loginLevej', $_SESSION['user']['level'])->
                assign('formValidateToken', $_SESSION['formValidate']['new'], true)->
                assign('serviceName', serviceName)->
                assign('extraCSS')->
                assign('extraJS')->
                assign('serviceName', serviceName);
        APP::smarty()->caching = 0;
        APP::smarty()->force_compile = true;
        APP::smarty()->cache_lifetime = 1;
    }

    public function addTitle($text)
    {
        $title = $this->siteTitle . ' &#124; ' . $text;
        APP::smarty()->assign('siteTitle', $title);
    }

    public function addCSS()
    {
        $css = func_get_args();
        if (!empty($css)) {
            $pacage = APP::route()->getGlobalRewrite();
            $pacage = $pacage['pacage'];
            foreach ($css as $style) {
                $href = rootpatch . "app/templates/$pacage/css/$style.css";
                array_push($this->extraCSS, $href);
            }
        }

        APP::smarty()->assign('extraCSS', $this->extraCSS);
    }

    public function addJS()
    {
        $js = func_get_args();
        if (!empty($js)) {
            $pacage = APP::route()->getGlobalRewrite();
            $pacage = $pacage['pacage'];
            foreach ($js as $file) {
                $href = rootpatch . "app/templates/$pacage/js/$file.js";
                array_push($this->extraJS, $href);
            }
        }

        APP::smarty()->assign('extraJS', $this->extraJS);
    }

    public function setTpl($name)
    {
        $this->template = $name;
    }

    public function hideTemplate()
    {
        $this->displayTemplate = false;
    }

    public static function validateToken($csrftoken = null)
    {
        $var = ($csrftoken === null ? Help::serverVar('post', 'csrftoken') : $csrftoken);
        if (!empty($var)) {
            $session = $_SESSION['formValidate']['old'];
            if ($var === $session) {
                return true;
            }
        }
        return false;
    }

    public static function newToken()
    {
        return $_SESSION['formValidate']['new'];
    }

}
