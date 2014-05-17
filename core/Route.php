<?php

class Route
{

    private $routePacage;
    private $routeComponents;
    private $routeControllerActions;
    private $routeModelActions;
    private $dialogs;
    private $globalRewrite;

    public function __construct()
    {
        $this->routeComponents = array();
        $this->routeControllerActions = array();
        $this->routeModelActions = array();
        $this->routePacage = array();
        $this->dialogs = array();
    }

    private static function addArray()
    {
        $ar = func_get_args();
        $ar = $ar[0];
        $args = count($ar);
        $result = array();
        if (($args - 1) % 2 === 0) {
            for ($i = 1; $i < $args; $i+=2) {
                $result = array_merge($result, array($ar[$i] => $ar[$i + 1]));
            }
            $result = array_merge($result, array('access' => 0));
            return array($ar[0] => $result);
        } elseif (is_numeric($ar[$args - 1]) && ($args - 2) % 2 === 0) {
            for ($i = 1; $i < $args; $i+=2) {
                $result = array_merge($result, array($ar[$i] => $ar[$i + 1]));
            }
            $result = array_merge($result, array('access' => $ar[$args - 1]));
            return array($ar[0] => $result);
        } else {
            die('wrong number of parameters set');
        }
    }

    /**
     * 
     * @return \Route
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
     * Adds component, eg. AdminGallery to global rewrite rules.
     * 
     * Usage: addComponent('Component name', 'language code', 'rewrite-name');
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
     * @return string
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
     * @return string
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
     * @return string
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
     * @return string
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
    public function getRouteComponents()
    {
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
