<?php

class AdminHomeModel extends Model
{

    public function __construct()
    {
        parent::__construct();

        User::assignUserToSmarty();
        self::addTitle('Panel');
    }

}
