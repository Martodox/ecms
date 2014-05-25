<?php

class globalRewrite
{

    /**
     * Holds current link data
     * @var Array
     */
    private static $link;

    /**
     * routeDialogs from all around the app
     * @var Array
     */
    private static $routeDialogs;

    /**
     * app pacages from all around the app
     * @var Array
     */
    private static $routePacage;

    /**
     * app components from all around the app
     * @var Array
     */
    private static $routeComponents;

    /**
     * controller and model actions from all around the app
     * @var Array
     */
    private static $routeActions;

    /**
     * Current language from session variable
     * @var String
     */
    private static $cLang;

    /**
     *
     * @var String 
     */
    private $action;

    /**
     *
     * @var String 
     */
    private $pacage;

    /**
     *
     * @var String 
     */
    private $component;

    /**
     *
     * @var String 
     */
    private $file;

    /**
     *
     * @var Array 
     */
    private $vars;

    /**
     *
     * @var int 
     */
    private $access;

    /**
     *
     * @var int 
     */
    private $position;

    /**
     *
     * @var boolean
     */
    private $isPacageSet;

    /**
     *
     * @var boolean
     */
    private $isActionSet;

    /**
     *
     * @var boolean
     */
    private $isComponentSet;

    public function __construct()
    {
        self::$cLang = $_SESSION['lang'];
        self::$routeActions = App::$route->getRouteActions();
        self::$routeComponents = App::$route->getRouteComponents();
        self::$routeDialogs = App::$route->getRouteDialogs();
        self::$routePacage = App::$route->getRoutePacage();


        $this->position = 0;
        $this->isPacageSet = false;
        $this->isActionSet = false;
        $this->isComponentSet = false;
        $this->action = "";
        $this->component = "Home";
        $this->file = "";
        $this->pacage = "Default";
        $this->vars = array();
        $defaultaccess = (empty(self::$routePacage[$this->pacage]['access']) ? 0 : self::$routePacage[$this->pacage]['access']);
        $this->access = $defaultaccess;

        self::setLink();

        self::setSmartyLang(self::$routePacage, 'p');
        self::setSmartyLang(self::$routeDialogs, 'l');
        self::setSmartyLang(self::$routeComponents, 'c');
        self::setSmartyLang(self::$routeActions['Model'], 'a');
        self::setSmartyLang(self::$routeActions['Controller'], 'a');

        $this->setRewrite(self::$routePacage, $this->pacage, $this->isPacageSet);
        $this->fixPosition();
        $this->setRewrite(self::$routeComponents, $this->component, $this->isComponentSet);
        $this->setAction(self::$routeActions);
        $this->cleanVars();

        $compile = $this->compile();

        App::$smarty->assign('g_vars', $this->vars);
        App::$smarty->assign('rewrite', $compile);
        $tmp = (empty($this->vars) ? false : true);
        App::$smarty->assign('isVarSet', $tmp);

        App::$route->setGlobalRewrite($compile);
    }

    /**
     * Breakes $_GET['link'] into logic parts
     * @return void
     */
    static private function setLink()
    {
        if (!isset($_GET['get'])) {
            $_GET['get'] = "";
        }

        $link = explode('/', $_GET['get']);
        if (empty($link)) {
            $link[0] = 'start';
        }
        for ($i = 0; $i <= 3; $i++) {
            if (!isset($link[$i])) {
                $link[$i] = "";
            }
        }

        self::$link = $link;
    }

    /**
     * Cleans get additional variables with htmlspecialchars
     * @return void
     */
    private function cleanVars()
    {
        foreach ($this->vars as &$var) {
            $var = htmlspecialchars($var);
        }
    }

    /**
     * Gathers all language dialogs around the app
     * @param App::$route->get... $src
     * @param String $prefix
     * @return void
     */
    private static function setSmartyLang($src, $prefix)
    {
        foreach ($src as $key => $class) {
            App::$smarty->assign($prefix . '_' . $key, $class[$_SESSION['lang']], true);
        }
    }

    /**
     * Sets pacages and components routes
     * @param Array $source
     * @param integer $position
     * @param String $result
     * @param boolean $isset
     * @return void
     */
    private function setRewrite($source, &$result, &$isset = false)
    {
        foreach ($source as $key => $class) {
            if (in_array(self::$link[$this->position], $class, true)) {
                $result = htmlspecialchars($key);
                $isset = true;
                if (!empty($class['access'])) {
                    $this->setAccess($class['access']);
                }
                break;
            }
        }
    }

    /**
     * Sets action and points to right file
     * @param Array $source
     * @param integer $position
     * @param String $result
     * @param boolean $isset
     * @return void
     */
    private function setAction($source)
    {
        foreach ($source as $key => $class) {
            foreach ($class as $actionName => $action) {
                if (in_array(self::$link[$this->position], $action, true) || in_array(self::$link[$this->position + 1], $action, true)) {
                    $this->action = htmlspecialchars($actionName);
                    $this->file = htmlspecialchars($key);
                    $this->isActionSet = true;
                    if (!empty($action['access'])) {
                        $this->setAccess($action['access']);
                    }

                    break;
                }
            }
        }
    }

    /**
     * Elevates access level
     * @param int $access
     * @return void
     */
    private function setAccess($access)
    {
        if (isset($access) && is_int($access)) {
            if ($this->access <= $access && $access !== 0) {
                $this->access = $access;
            }
        }
    }

    /**
     * Checks if paage is set and adjusts the position
     * 
     * @return void
     */
    private function fixPosition()
    {
        $this->position = ($this->isPacageSet ? 1 : 0);
    }

    /**
     * Returns an array which then gets procesed bo app engine in SSF.php file
     * 
     * @return Array 
     */
    private function compile()
    {


        if (!$this->isComponentSet) {
            $this->component = $this->pacage . $this->component;
            $defaultPremissions = App::$route->getRouteComponents($this->component);
            $defaultPremissions['access'] = (!empty($defaultPremissions['access']) ? $defaultPremissions['access'] : 0);
            if ($this->access < $defaultPremissions['access']) {
                $this->access = $defaultPremissions['access'];
            }
        }


        //Determins which part of link are variables.
        if ($this->isActionSet && $this->isComponentSet) {
            $this->vars = explode(',', self::$link[$this->position + 2]);
        } else if (($this->isActionSet && !$this->isComponentSet) || (!$this->isActionSet && $this->isComponentSet)) {
            $this->vars = explode(',', self::$link[$this->position + 1]);
        } else {
            if (!$this->isActionSet && !$this->isComponentSet) {
                $this->vars = explode(',', self::$link[$this->position + 0]);
            }
        }



        return array(
            'pacage' => $this->pacage,
            'component' => $this->component,
            'action' => $this->action,
            'file' => $this->file,
            'vars' => $this->vars,
            'access' => $this->access
        );
    }

}
