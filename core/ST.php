<?php

//Simple Text
class ST
{

    public static function gP($class)
    {
        $var = App::$route->getRoutePacage();
        return $var[$class][$_SESSION['lang']];
    }

    public static function gC($class)
    {
        $var = App::$route->getRouteComponents();
        return $var[$class][$_SESSION['lang']];
    }

    public static function gAM($class)
    {
        $var = App::$route->getRouteActions();
        return $var['Model'][$class][$_SESSION['lang']];
    }

    public static function gAC($class)
    {
        $var = App::$route->getRouteActions();
        return $var['Controller'][$class][$_SESSION['lang']];
    }

//    public static function gL($dialog)
//    {
//        return $this->langArray[$dialog][$_SESSION['lang']];
//    }

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
        SLog::toFile($var);
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
