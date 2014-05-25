<?php

//Simple Text
class ST
{

    public static function gP($pacage)
    {
        $var = App::$route->getRoutePacage();
        return $var[$pacage][$_SESSION['lang']];
    }

    public static function gC($class)
    {
        $var = App::$route->getRouteComponents();
        return $var[$class][$_SESSION['lang']];
    }

    public static function gAM($action)
    {
        $var = App::$route->getRouteActions();
        return $var['Model'][$action][$_SESSION['lang']];
    }

    public static function gAC($action)
    {
        $var = App::$route->getRouteActions();
        return $var['Controller'][$action][$_SESSION['lang']];
    }

    public static function gD($dialog)
    {
        $var = App::$route->getRouteDialogs();
        return $var[$dialog][$_SESSION['lang']];
    }

    public static function currentPacage()
    {
        $var = App::$route->getGlobalRewrite();
        return $var['pacage'];
    }

    public static function currentComponent()
    {
        $var = App::$route->getGlobalRewrite();
        return $var['component'];
    }

    public static function currentAction()
    {
        $var = App::$route->getGlobalRewrite();
        return $var['action'];
    }

    public static function currentActionFile()
    {
        $var = App::$route->getGlobalRewrite();
        return $var['file'];
    }

    public static function isActionSet($name = null)
    {
        $var = App::$route->getGlobalRewrite();
        if ($name != null) {
            if ($var['action'] != $name) {
                return false;
            }
        }
        if (empty($var['action'])) {
            return false;
        }
        return true;
    }

    public static function isVarSet()
    {
        $vartmp = App::$route->getGlobalRewrite();
        return (empty($vartmp['vars']) ? false : true);
    }

    public static function currentVars($id = false)
    {
        $vartmp = App::$route->getGlobalRewrite();
        if ($id === false) {
            return $vartmp['vars'];
        }
        $var = $vartmp['vars'][$id - 1];
        if (null !== $var) {
            return $var;
        } else {
            return false;
        }
    }

}
