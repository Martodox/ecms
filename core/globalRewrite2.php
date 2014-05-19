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

    public function __construct()
    {
        $this->access = 0;
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
    }

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
     */
    private static function setSmartyLang($src, $prefix)
    {
        
    }

}
