<?php

session_start();

define("config_MySql_host", "localhost");
define("config_MySql_username", "username");
define("config_MySql_password", "password");
define("config_MySql_dbname", "dbname");

//site directory
define("rootpatch", "/");

define("devmode", true);

//needs database with user table
define("secureLogin", true);
//in minutes
define("loginTimeout", (int) 10);
define("serviceName", "eCMS");

define("defaultLanguage", "pl");
// 0 - disabled, 1 - enabled
define("caching", 0);
date_default_timezone_set('Europe/Warsaw');
setlocale(LC_ALL, array('pl_PL', 'pl', 'Polish_Poland.28592'));
define('SMARTY_RESOURCE_CHAR_SET', 'UTF-8');

