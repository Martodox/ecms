<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', getcwd() . '/');
}

$folder[0] = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(realpath('core')), RecursiveIteratorIterator::CHILD_FIRST);
$folder[1] = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(realpath('app')), RecursiveIteratorIterator::CHILD_FIRST);


require_once ABSPATH . 'includes/Help.php';
require_once ABSPATH . 'includes/smarty/Smarty.class.php';
require_once ABSPATH . 'includes/classMysql.php';
require_once ABSPATH . 'includes/Upload.php';
require_once ABSPATH . 'core/Route.php';


$fileIgnore = array('Route.php', 'classIncluder.php', 'SSF.php', 'App.php', 'globalRewrite.php', 'ST.php', 'Eloquent.php');
require_once ABSPATH . 'core/App.php';
new App();
foreach ($folder as $one) {
    foreach ($one as $name => $object) {
        if (substr($name, -4) === '.php') {
            $filename = new SplFileInfo($name);
            if (!in_array($filename->getFilename(), $fileIgnore)) {
                require_once $name;
            }
        }
    }
}

require_once ABSPATH . 'core/globalRewrite.php';
require_once ABSPATH . 'core/ST.php';
require_once ABSPATH . 'includes/User.php';
require_once ABSPATH . 'includes/SLog.php';

