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
            $salt = App::$db->
                    create('SELECT salt FROM user WHERE email = :email AND `active` = 1')->
                    bind($email, 'email')->
                    execute();
            $loginfail = false;

            if (!empty($salt)) {
                $password = Help::saltPassword($password, $salt[0]['salt']);
                $user = App::$db->
                        create('SELECT * FROM user WHERE password = :password')->
                        bind($password, 'password')->
                        execute();
            } else {
                $loginfail = true;
            }

            if (!empty($user)) {
                $user = $user[0];
                session_regenerate_id();
                User::logIn();
                User::setLevel($user['level']);
                User::setUserField('id', $user['id']);
                User::setUserField('first_name', $user['first_name']);
                User::setUserField('last_name', $user['last_name']);
                User::setUserField('email', $user['email']);
                SLog::logActivity('LOGIN');
                Help::redirect('Admin');
            } else {
                $loginfail = true;
            }

            if ($loginfail) {
                SLog::logActivity('FAILLOGIN');
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
        session_regenerate_id();
        Help::redirect('Auth');
    }

}
