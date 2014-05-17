<?php

App::$route->
        addMAction('forgotPassword', 'pl', 'przypomnij-haslo');

class AuthHomeModel extends Model
{

    public function __construct()
    {

        parent::__construct();

        if (Help::isLoggedIn() && !Help::isActionSet('AdminLogOut')) {
            //Help::redirect('Admin');
        }

        if (!empty($_SESSION['wrongEmail'])) {
            App::$smarty->assign('wrongemail', $_SESSION['wrongEmail']);
        }

        if (Help::getVar(1) == 'error') {
            $temp = true;
        } else {
            $temp = false;
        }
        App::$smarty->assign('showloginerror', $temp);
    }

}