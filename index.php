<?php

define('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
define('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

require(ROOT.'core/Model.php');
require(ROOT.'core/Controller.php');

$params = explode('/',$_GET['p']);
$controller = !empty($params[0]) ? $params[0] : 'home';
$action = isset($params[1]) ? $params[1] : 'index';
$action = ( $action == "" ) ? "index" : $action;

if (!file_exists('controllers/'.$controller.'Controller.php')){

	require('404.php') ;
	return;
}
else{

	require('controllers/'.$controller.'Controller.php');

	$controller = ucfirst($controller)."Controller";
	$controller = new $controller();
}
if (method_exists($controller, $action)){

	unset($params[0]);
	unset($params[1]);

	session_start();
	call_user_func_array(array($controller,$action),$params);
}
else{
	require('404.php');
}