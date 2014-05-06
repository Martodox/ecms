<?php

session_start();

define("config_MySql_host", "localhost");
define("config_MySql_username", "username");
define("config_MySql_password", "password");
define("config_MySql_dbname", "dbname");

if (empty($_SESSION['lang'])) {
    $_SESSION['lang'] = 'pl';
}

//site directory
define("rootpatch", "/");

define("devmode", true);

define("serviceName", "eCMS");

define("defaultLanguage", "pl");

define("caching", 0);
date_default_timezone_set('Europe/Warsaw');
setlocale(LC_ALL, array('pl_PL', 'pl', 'Polish_Poland.28592'));
define('SMARTY_RESOURCE_CHAR_SET', 'UTF-8');

