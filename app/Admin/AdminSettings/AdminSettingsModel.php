<?php

App::$route->
        addMAction('premissionHome', 'pl', 'ustawienia-dostepu');

class AdminSettingsModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        User::assignUserToSmarty();
        if (!ST::isActionSet()) {
            Help::redirect('Admin', 'AdminSettings', 'premissionHome');
        }
    }

    public function premissionHome()
    {
        $this->passToControll(syncCategories);
    }

}
