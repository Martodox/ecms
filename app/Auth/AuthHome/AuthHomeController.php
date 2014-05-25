<?php

App::$route->
        addCAction('AdminLoginAuthorize', 'pl', 'autoryzacja')->
        addCAction('AdminLogOut', 'pl', 'wyloguj-sie');

class AuthHomeController extends Controller
{

    public function AdminLoginAuthorize()
    {

        if (!$this->model->blocklogin) {

            if (!Model::validateToken()) {
                Help::redirect('Auth', null, null, 'error,token');
            }
            $password = Help::serverVar('post', 'password');
            $email = Help::serverVar('post', 'email');
            $salt = DB_user::getSalt($email);
            $loginfail = false;

            if ($salt) {
                $password = Help::saltPassword($password, $salt);
                $user = DB_user::authenticateUser($email, $password);
            } else {
                $loginfail = true;
            }

            if ($user) {
                session_regenerate_id();
                User::logIn();
                User::setLevel($user['level']);
                User::setUserField('id', $user['id']);
                User::setUserField('first_name', $user['first_name']);
                User::setUserField('last_name', $user['last_name']);
                User::setUserField('email', $user['email']);
                SLog::logActivity('LOGIN');
                DB_user_logs::resetLoginAttempts();
                DB_user::updateLastActivity();
                Help::redirect('Admin');
            } else {
                $loginfail = true;
            }

            if ($loginfail) {
                SLog::logActivity('FAILLOGIN', 'A');
                $_SESSION['wrongEmail'] = $email;
                Help::redirect('Auth', null, null, 'error');
            }
        } else {
            Help::redirect('Auth');
        }
    }

    public function AdminLogOut()
    {
        SLog::logActivity('LOGOUT');
        User::logOut();
        Help::redirect('Auth');
    }

}
