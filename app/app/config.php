<?php
$_config['server']['url'] = "http://localhost/";
$_config['server']['host'] = $_SERVER['DOCUMENT_ROOT'] . "/";

define('DBUSER', 'root');
define('DBPASS', 'rootpassword');
define('DBHOST', 'mysql');
define('DBNAME', 'fw');

define('JWT_SECRET', "fakesecretkey");
define('EXPIRATION_HOUR_JWT_TOKEN', 60 * 60 * 2);
