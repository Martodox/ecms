<?php

class globalRewrite2
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
        $this->access = 0;
        $this->position = 0;
        $this->isPacageSet = false;
        $this->isActionSet = false;
        $this->isComponentSet = false;
        $this->action = "";
        $this->component = "Home";
        $this->file = "";
        $this->pacage = "Default";
        $this->vars = array();
        self::$cLang = $_SESSION['lang'];
        self::$routeActions = App::$route->getRouteActions();
        self::$routeComponents = App::$route->getRouteComponents();
        self::$routeDialogs = App::$route->getRouteDialogs();
        self::$routePacage = App::$route->getRoutePacage();

        self::setLink();

        self::setSmartyLang(self::$routePacage, 'p');
        self::setSmartyLang(self::$routeDialogs, 'l');
        self::setSmartyLang(self::$routeComponents, 'c');
        self::setSmartyLang(self::$routeActions['Model'], 'a');
        self::setSmartyLang(self::$routeActions['Controller'], 'a');

        self::setRewrite(self::$routePacage, $this->position, $this->pacage, $this->isPacageSet);
        $this->fixPosition();
        self::setRewrite(self::$routeComponents, $this->position, $this->component, $this->isComponentSet);


        $compile = $this->compile();
        App::$route->setGlobalRewrite($compile);
    }

    /**
     * 
     * @return void
     */
    static private function setLink()
    {
        if (!isset($_GET['get'])) {
            $_GET['get'] = "";
        }

        $link = explode('/', $_GET['get']);

        for ($i = 0; $i <= 3; $i++) {
            if (!isset($link[$i])) {
                $link[$i] = "";
            }
        }
        self::$link = $link;
    }

    /**
     * 
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
     * 
     * @param Array $source
     * @param integer $position
     * @param String $result
     * @param boolean $isset
     * @return void
     */
    private function setRewrite($source, $position, &$result, &$isset = false)
    {
        foreach ($source as $key => $class) {
            if (in_array(self::$link[$position], $class, true)) {
                $result = htmlspecialchars($key);
                $isset = true;
                if (isset($class['access']) && is_int($class['access'])) {
                    if ($this->access < $class['access'] && $class['access'] !== 0) {
                        $this->access = $class['access'];
                    }
                }
                break;
            }
        }
    }

    /**
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


        if (!$this->isActionSet) {
            $this->component = $this->pacage . $this->component;
            $defaultPremissions = App::$route->getRouteComponents($this->component);
            $defaultPremissions['access'] = (!empty($defaultPremissions['access']) ? $defaultPremissions['access'] : 0);
            if ($this->access < $defaultPremissions['access']) {
                $this->access = $defaultPremissions['access'];
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
