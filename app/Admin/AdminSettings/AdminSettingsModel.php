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

        $components = App::$route->getRouteComponents();
        $datebase = App::$db->simpleQuery('SELECT * FROM `admin_permissions`');

        $databaseComponents = [];
        $fileCompontnts = [];

        foreach ($components as $key => $value) {
            $databaseComponents[] = $key;
        }
        foreach ($datebase as $value) {
            $fileCompontnts[] = $value['component'];
        }

        $dif = array_diff($fileCompontnts, $databaseComponents);
        $dif2 = array_diff($databaseComponents, $fileCompontnts);

        foreach ($dif as $comp) {
            App::$db->
                    create('DELETE FROM `admin_permissions` WHERE  `component` = :component LIMIT 1')->
                    bind($comp, 'component')->
                    execute();
        }

        foreach ($dif2 as $comp) {
            App::$db->
                    create('INSERT INTO `admin_permissions` (`component`, `level`) VALUES (:component, 10) ON DUPLICATE KEY UPDATE component = component')->
                    bind($comp, 'component')->
                    execute();
        }


        $datebase = App::$db->simpleQuery('SELECT * FROM `admin_permissions`');

        App::$smarty->assign('components', $datebase);
    }

}
