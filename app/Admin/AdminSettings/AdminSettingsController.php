<?php

class AdminSettingsController extends Controller
{

    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function syncCategories()
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
