<?php
/* [DATABASE SETTINGS] */
// CHANGE THESE TO YOUR OWN!
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

/* [MUTE NOTIFICATIONS] */
error_reporting(E_ALL & ~E_NOTICE);

/* [PATH] */
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR);
?>