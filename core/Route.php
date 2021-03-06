<?php

class Route
{

    /**
     *
     * @var Array
     */
    private $routePacage;

    /**
     *
     * @var Array
     */
    private $routeComponents;

    /**
     *
     * @var Array
     */
    private $routeControllerActions;

    /**
     *
     * @var Array
     */
    private $routeModelActions;

    /**
     *
     * @var Array
     */
    private $dialogs;

    /**
     *
     * @var Array
     */
    private $globalRewrite;

    public function __construct()
    {
        $this->routeComponents = array();
        $this->routeControllerActions = array();
        $this->routeModelActions = array();
        $this->routePacage = array();
        $this->dialogs = array();
    }

    /**
     * 
     * @return Array
     */
    private static function addArray()
    {
        $ar = func_get_args();
        $ar = $ar[0];
        $args = count($ar);
        $start = (is_int($ar[0]) ? 1 : 0);
        $result = array();
        if (($args - 1 - $start) % 2 === 0) {
            for ($i = 1 + $start; $i < $args; $i+=2) {
                $result = array_merge($result, array($ar[$i] => $ar[$i + 1]));
            }
            if ($start == 1) {
                $result = array_merge($result, array('access' => $ar[0]));
            }

            return array($ar[0 + $start] => $result);
        } else {
            die('wrong number of parameters set for key: ' . $ar[0 + $start]);
        }
    }

    /**
     * Ads pacage SEO link to rewrite engine. Can be used with unlimited number of parameters.<br/>
     * First parameter can be either access level or pacage name<br/>
     * The following must come in pairs 'langCode', 'string corresponding'
     * 
     * @return \Route
     * @example App::$route->addPacage('Default', 'pl', 'start', 'en', 'start');
     * @example App::$route->addPacage(3, 'Admin', 'pl', 'admin', 'en', 'admin');
     * 
     */
    public function addPacage()
    {
        $add = self::addArray(func_get_args());

        $this->routePacage = array_merge($this->routePacage, $add);
        return $this;
    }

    /**
     *
     * @return \Route
     */
    public function addDialog()
    {
        $add = self::addArray(func_get_args());
        $this->dialogs = array_merge($this->dialogs, $add);
        return $this;
    }

    /**
     *
     * @return \Route
     */
    public function addComponent()
    {
        $add = self::addArray(func_get_args());
        $this->routeComponents = array_merge($this->routeComponents, $add);
        return $this;
    }

    /**
     *
     * @return \Route
     */
    public function addCAction()
    {
        $add = self::addArray(func_get_args());
        $this->routeControllerActions = array_merge($this->routeControllerActions, $add);
        return $this;
    }

    /**
     *
     * @return \Route
     */
    public function addMAction()
    {
        $add = self::addArray(func_get_args());
        $this->routeModelActions = array_merge($this->routeModelActions, $add);
        return $this;
    }

    /**
     *
     * @param String $name
     * @return String
     */
    public function returnPacage($name)
    {
        if (isset($this->routePacage[$name][$_SESSION['lang']])) {
            return $this->routePacage[$name][$_SESSION['lang']];
        }
        return self::errorMessage($name);
    }

    /**
     *
     * @param String $name
     * @return String
     */
    public function returnComponent($name)
    {
        if (isset($this->routeComponents[$name][$_SESSION['lang']])) {
            return $this->routeComponents[$name][$_SESSION['lang']];
        }
        return self::errorMessage($name);
    }

    /**
     *
     * @param String $name
     * @return String
     */
    public function returnAction($name)
    {
        if (isset($this->routeModelActions[$name][$_SESSION['lang']])) {
            return $this->routeModelActions[$name][$_SESSION['lang']];
        }
        if (isset($this->routeControllerActions[$name][$_SESSION['lang']])) {
            return $this->routeControllerActions[$name][$_SESSION['lang']];
        }
        return self::errorMessage($name);
    }

    /**
     *
     * @param String $name
     * @return String
     */
    public function returnDialog($name)
    {
        if (isset($this->dialogs[$name][$_SESSION['lang']])) {
            return $this->dialogs[$name][$_SESSION['lang']];
        }
        return self::errorMessage($name);
    }

    private static function errorMessage($name)
    {
        return '<h1>ERROR. VAR: <i>' . $name . '</i> DOES NOT EXISTS</h1>';
    }

    /**
     * 
     * @return Array
     */
    public function getRoutePacage()
    {
        return $this->routePacage;
    }

    /**
     * 
     * @return Array
     */
    public function getRouteComponents($componentName = null)
    {
        if ($componentName !== null) {
            return $this->routeComponents[$componentName];
        }
        return $this->routeComponents;
    }

    /**
     * 
     * @return Array
     */
    public function getRouteActions()
    {
        return array('Model' => $this->routeModelActions, 'Controller' => $this->routeControllerActions);
    }

    /**
     * 
     * @return Array
     */
    public function getRouteDialogs()
    {
        return $this->dialogs;
    }

    /**
     * 
     * @param type Route::$globalRewrite
     */
    public function setGlobalRewrite($globalRewrite)
    {
        $this->globalRewrite = $globalRewrite;
    }

    /**
     * 
     * @return Array
     */
    public function getGlobalRewrite()
    {
        return $this->globalRewrite;
    }

    /**
     * 
     * @return Array
     */
    public function getGlobalPacage()
    {
        return $this->globalRewrite['pacage'];
    }

    /**
     * 
     * @return Array
     */
    public function getGlobalComponent()
    {
        return $this->globalRewrite['component'];
    }

}
