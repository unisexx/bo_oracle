<?php
session_start();
header('Content-type: text/html; charset=utf-8');
// debug
//ini_set('display_errors', 'On');
//error_reporting(E_ALL | E_STRICT);
// config
define('SERVER', 'online');
define('WEBSESSION', 'beidblog');
define('ROOT_DIR', dirname (__FILE__));
define('INCLUDE_DIR', ROOT_DIR.'/include');
define('LIBRARY_DIR', ROOT_DIR.'/library');
define('MODULES_DIR', ROOT_DIR.'/modules');
define('TEMPLATE_DIR', ROOT_DIR.'/template');
define('IMAGES_DIR', 'images');
define('UPLOAD_DIR', 'uploads');
define('IMG_MAX_WIDTH',800);
define('IMG_MAX_HEIGHT',600);
define('USER_IMG_WIDTH',100);
define('USER_IMG_HEIGHT',100);
// database
$config['db'] = array(
	'fd-server' => array(
		'driver' => 'mysql',
		'host' => '192.168.0.2',
		'database' => 'beid_blog_forum',
		'username' => 'root',
		'password' => 'Des@gn',
		'encode' => 'utf8'
	),
	'home' => array(
		'driver' => 'mysql',
		'host' => 'localhost',
		'database' => 'beid_blog_forum',
		'username' => 'root',
		'password' => '',
		'encode' => 'utf8'
	),
	'online' => array(
		'driver' => 'mysql',
		'host' => 'localhost',
		'database' => 'beid_blogforum',
		'username' => 'beid',
		'password' => 'b@1d?7',
		'encode' => 'utf8'
	)
);
// connect
$DBCONFIG = $config['db'][SERVER]['driver'].'://'.$config['db'][SERVER]['username'].':'.$config['db'][SERVER]['password'].'@'.$config['db'][SERVER]['host'].'/'.$config['db'][SERVER]['database'];
$ENCODE = $config['db'][SERVER]['encode'];
// include
include LIBRARY_DIR.'/adodb/adodb.inc.php';
include LIBRARY_DIR.'/adodb/adodb-active-record.inc.php';
include LIBRARY_DIR.'/pagination.class.php';
include LIBRARY_DIR.'/main.php';
include LIBRARY_DIR.'/html.class.php';
include LIBRARY_DIR.'/upload.class.php';
include LIBRARY_DIR.'/smarty/Smarty.class.php';
include LIBRARY_DIR.'/base.class.php';
?>