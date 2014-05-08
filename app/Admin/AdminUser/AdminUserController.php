<?php

App::$route->
        addCAction('AdminPasswordChange', 'pl', 'zapisz-zmiane-hasla')->
        addCAction('AdminDetailChange', 'pl', 'zapisz-zmiane-danych')->
        addCAction('AdminAddUser', 'pl', 'zapisz-uzytkownika')->
        addCAction('AdminSaveUser', 'pl', 'zapisz-zmiany-w-koncie')->
        addCAction('ajaxCheckEmail', 'pl', 'sprawdz-adres-w-bazie')->
        addCAction('ajaxRemoveUser', 'pl', 'skasuj-uzytkownika')->
        addCAction('AdminChangeStatus', 'pl', 'zmien-status');

class AdminUserController extends Controller
{

    public function AdminPasswordChange()
    {
        if (!Model::validateToken()) {
            Help::redirect('Admin', 'AdminUser', null, 'error,token');
        }
        $oldPassword = Help::serverVar('post', 'oldpassword');
        $newPassword = Help::serverVar('post', 'newpassword');
        $newPasswordAgain = Help::serverVar('post', 'repeatnewpassword');

        if (!Help::validatePassword($newPassword, $newPasswordAgain, $oldPassword)) {
            Help::redirect('Admin', 'AdminUser', null, 'error,passwordmissmatch');
        }

        $user = App::$db->
                create('SELECT salt, password FROM user WHERE id = :id')->
                bind((int) User::getID(), 'id', 'int')->
                execute();
        $user = $user[0];

        if ($user['password'] === Help::saltPassword($oldPassword, $user['salt'])) {
            $salt = Help::getSalt();
            $newPassword = Help::saltPassword($newPassword, $salt);
            App::$db->
                    create('UPDATE user SET password = :password, salt = :salt WHERE id = :id')->
                    bind($newPassword, 'password')->
                    bind($salt, 'salt')->
                    bind((int) User::getID(), 'id', 'int')->
                    execute();
            SLog::logActivity('SELFPASSWORDCHANGE');
            Help::redirect('Admin', 'AdminUser', null, 'success,password');
        }

        Help::redirect('Admin', 'AdminUser', null, 'error,unknown');
    }

    public function AdminDetailChange()
    {
        if (!Model::validateToken()) {
            Help::redirect('Admin', 'AdminUser', null, 'error,token');
        }
        $email = Help::serverVar('post', 'emailaddress');
        $name = Help::serverVar('post', 'firstname');
        $surname = Help::serverVar('post', 'lastname');
        if (empty($email) || empty($name) || empty($surname)) {
            Help::redirect('Admin', 'AdminUser', null, 'error,details');
        }

        if ($email !== User::getField('email')) {
            if (!Help::validateEmail($email)) {
                Help::redirect('Admin', 'AdminUser', null, 'error,wrongemail');
            }

            if (Help::dbCheckIfValueExists('user', 'email', $email)) {
                Help::redirect('Admin', 'AdminUser', null, 'error,emailnotunique');
            }
        }

        App::$db->
                create('UPDATE user SET email = :email, first_name = :first_name, last_name = :last_name WHERE id = :id')->
                bind($email, 'email')->
                bind($name, 'first_name')->
                bind($surname, 'last_name')->
                bind((int) User::getID(), 'id', 'int')->
                execute();


        User::setUserField('email', $email);
        User::setUserField('first_name', $name);
        User::setUserField('last_name', $surname);
        Help::redirect('Admin', 'AdminUser', null, 'success,detailssaved');
    }

    public function AdminSaveUser()
    {

        Help::ajaxAuthenticateRequest();


        $json = json_decode(Help::serverVar('post', 'data'));

        $data = Help::ajaxSimplifyObjectArray($json);

        $isEmpty = false;
        foreach ($data as $value) {
            if (empty($value)) {
                $isEmpty = true;
                break;
            }
        }

        $msg = '';
        $error = false;
        $token = Model::validateToken($data['csrftoken']);
        $return = array();

        if (!$isEmpty && $token) {

            if (Help::dbCheckIfValueExists('user', 'email', $data['emailaddress']) || !Help::validateEmail($data['emailaddress'])) {
                $msg = $msg . ',wrongemail';
                $error = true;
            }

            if (!Help::validatePassword($data['newpassword'], $data['repeatnewpassword'])) {
                $msg = $msg . ',passwordMatch';
                $error = true;
            }
        } else {
            if (!$token) {
                $msg = $msg . ',badtoken';
            }
            $error = true;
            $msg = $msg . ',generalerror';
        }

        if (!$error) {
            $salt = Help::getSalt();
            $password = Help::saltPassword($data['newpassword'], $salt);
            App::$db->
                    create('INSERT INTO user (id, email, level, first_name, last_name, salt, password) VALUES (null, :email, :level, :first_name, :last_name, :salt, :password)')->
                    bind($data['emailaddress'], 'email')->
                    bind((int) $data['level'], 'level', 'int')->
                    bind($data['firstname'], 'first_name')->
                    bind($data['lastname'], 'last_name')->
                    bind($salt, 'salt')->
                    bind($password, 'password')->
                    execute();
        }

        $return['token'] = Model::newToken();
        $return['error'] = $error;
        $return['msg'] = $msg;
        echo json_encode($return);
        $this->hideTemplate();
    }

    public function ajaxCheckEmail()
    {
        Help::ajaxAuthenticateRequest();

        $email = Help::serverVar('post');
        $email = $email['email'];
        if (Help::dbCheckIfValueExists('user', 'email', $email)) {
            $return['result'] = 'nook';
        } else {
            $return['result'] = 'ok';
        }
        $return['token'] = Model::newToken();
        echo json_encode($return);
        $this->hideTemplate();
    }

    public function ajaxRemoveUser()
    {
        Help::ajaxAuthenticateRequest();

        $json = json_decode(Help::serverVar('post', 'data'));
        $data = Help::ajaxSimplifyObjectArray($json);

        $token = Model::validateToken($data['csrftoken']);

        if ($token) {
            $error = false;
            $id = App::$db->
                    create('SELECT `id` FROM `user` WHERE `email` = :email')->
                    bind($data['removeemail'], 'email')->
                    execute();
            $id = $id[0]['id'];
            if (empty($id) || $id == 1) {
                $error = true;
            } else {
                App::$db->
                        create('DELETE FROM `user` WHERE  `id`= :id;')->
                        bind((int) $id, 'id', 'int')->
                        execute();
            }
        } else {
            $error = true;
        }

        $return['error'] = $error;
        $return['token'] = Model::newToken();
        echo json_encode($return);
        $this->hideTemplate();
    }

    public function AdminChangeStatus()
    {
        $id = ST::currentVars(1);

        if ($id != 1) {
            App::$db->
                    create('UPDATE `user` SET `active` = 1 - `active` WHERE `id` = :id')->
                    bind((int) $id, 'id', 'int')->
                    execute();
        }

        Help::redirect('Admin', 'AdminUser', 'allUserList');
    }

}
