<?php

APP::route()->addMAction('login', 'pl', 'zaloguj', 'en', 'login');
APP::route()->addMAction('forgotPassword', 'pl', 'przypomnij-haslo');

class AdminAuthModel extends Model {

    public function __construct() {

        parent::__construct();
        if (Help::isLoggedIn() && !Help::isActionSet('AdminLogOut')) {
            Help::redirect('Admin');
        }

        if (!empty($_SESSION['wrongEmail'])) {
            APP::smarty()->assign('wrongemail', $_SESSION['wrongEmail']);
            unset($_SESSION['wrongEmail']);
        }

        if (Help::getVar(1) == 'error') {
            $temp = true;
        } else {
            $temp = false;
        }
        APP::smarty()->assign('showloginerror', $temp);
    }

}
