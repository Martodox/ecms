<?php

class App
{

    /**
     *
     * @var Smarty
     */
    public static $smarty;

    /**
     *
     * @var Route 
     */
    public static $route;

    /**
     *
     * @var classMysql 
     */
    public static $db;

    public function __construct()
    {
        self::$smarty = new Smarty();
        self::$route = new Route();
        self::$db = classMysql::instance();
    }

}
