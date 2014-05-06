<?php

APP::route()->
        addMAction('allUserList', 'pl', 'lista-uzytkownikow')->
        addMAction('ajaxUserAdd', 'pl', 'zladuj-dane-uzytkownika-ajax')->
        addMAction('ajaxUserEdit', 'pl', 'edytuj-uzytkownika');

class AdminUserModel extends Model {

    public function __construct() {
        parent::__construct();
        Help::checkLoginRedirect();
        User::assignUserToSmarty();
        $this->addJS('modal_button', 'notify.min', 'simpleValidator', 'formSubmitBind', 'formSubmit', 'validatePlaces');
    }

    public function allUserList() {
        $this->setTpl('allUserList');
        $users = App::db()->simpleQuery('SELECT * FROM user ORDER BY id');
        App::smarty()->assign('allUsers', $users);
    }

    public function ajaxUserAdd() {
        $this->setTpl('addUser');
    }

    public function ajaxUserEdit() {
        $this->setTpl('editUser');
        $user = APP::db()->
                create('SELECT * FROM user WHERE id = :id LIMIT 1')->
                bind(Help::getVar(1), 'id')->
                execute();

        APP::smarty()->assign('user', $user[0]);
    }

}
