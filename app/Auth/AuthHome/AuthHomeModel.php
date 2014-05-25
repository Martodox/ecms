<?php

App::$route->
        addMAction('forgotPassword', 'pl', 'przypomnij-haslo');

class AuthHomeModel extends Model
{

    /**
     * Holds number of bad login attempts in past 15 minutes for a given user.
     * @var int
     */
    public $loginattempts;

    /**
     * How many user can make a mistake loggin in before gets banned for 15 minutes
     * @var int
     */
    public $allowedattemtps;

    /**
     * Tells login controller if it can authorize user
     * @var boolean
     */
    public $blocklogin;

    public function __construct()
    {
        parent::__construct();
        $this->blocklogin = false;
        $this->allowedattemtps = 10;

        if (Help::isLoggedIn() && !Help::isActionSet('AdminLogOut')) {
            Help::redirect('Admin');
        }

        $this->loginattempts = DB_user_logs::ipLoginAttempts();
        if (!Help::isActionSet('AdminLogOut')) {
            $this->blocklogin = ($this->loginattempts >= $this->allowedattemtps ? true : false);
            App::$smarty->assign('hideloginform', $this->blocklogin);
        } else {
            $this->blocklogin = false;
        }


        if (!empty($_SESSION['wrongEmail'])) {
            App::$smarty->assign('wrongemail', $_SESSION['wrongEmail']);
            $_SESSION['wrongEmail'] = "";
        }

        if (Help::getVar(1) == 'error') {
            $temp = true;
        } else {
            $temp = false;
        }
        App::$smarty->assign('showloginerror', $temp);
    }

}
