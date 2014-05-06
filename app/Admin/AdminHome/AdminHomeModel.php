<?php

class AdminHomeModel extends Model
{

    public function __construct()
    {
        parent::__construct();

        Help::checkLoginRedirect();
        User::assignUserToSmarty();
        self::addTitle('Panel');
    }

}
