<?php

class App
{

    /**
     * Is responsible for Smarty template engine inside the app
     * @link http://www.smarty.net/ Smarty home page
     * @var Smarty
     */
    public static $smarty;

    /**
     * Allows adding app routes and dialogs
     * @var Route 
     */
    public static $route;

    /**
     * Face for database class, can be changed to any POD compatible class
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
