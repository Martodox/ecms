<?php

class User
{

    public static function setUserField($name, $value)
    {
        $_SESSION['user'][$name] = $value;
    }

    public static function logIn()
    {
        $_SESSION['user']['logged'] = true;
    }

    public static function logOut()
    {
        unset($_SESSION['user']);
    }

    public static function setLevel($level)
    {
        $_SESSION['user']['level'] = $level;
    }

    public static function assignUserToSmarty()
    {
        App::$smarty->assign('user', $_SESSION['user']);
    }

    public static function getID()
    {
        return $_SESSION['user']['id'];
    }

    public static function getField($name)
    {
        if (!empty($_SESSION['user'][$name])) {
            return $_SESSION['user'][$name];
        }
        return false;
    }

}
