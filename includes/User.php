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
        $_SESSION['user']['level'] = 0;
        $_SESSION['user']['logged'] = false;
        session_regenerate_id();
    }

    public static function setLevel($level)
    {
        $_SESSION['user']['level'] = $level;
    }

    public static function getLevel()
    {
        return $_SESSION['user']['level'];
    }

    public static function checkFields()
    {
        if (empty($_SESSION['user']['logged'])) {
            $_SESSION['user']['logged'] = false;
        }

        if (empty($_SESSION['user']['level'])) {
            $_SESSION['user']['level'] = 0;
        }
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

    public static function isLogin()
    {
        if ($_SESSION['user']['logged']) {
            return true;
        }
        return false;
    }

}
