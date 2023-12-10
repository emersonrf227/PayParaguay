<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set("error_log", "php-error.log");

error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

session_start();
ob_start();

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$new = explode("/", $actual_link);
//define('URL', 'http://'.$new[2]."/");
//define('URL', 'https://bigdata.iliketechnology.com.br/');
// define('URL', 'http://' . $new[2] . '/');
define('URL', 'https://smartgateway.io/');
define('NODE_USER', "smartgate");
define('NODE_PWD', "W10aw3@se4!@#$%");
define('NODE_URL', "https://smartnode.iliketechnology.com.br/v1");
define('SMARTPAY_URL', "https://connect.smartpay.com.vc/api/smartpay/");
define('SMARTPAY_USER', "smartgate");
define('SMARTPAY_PWD', "SayzMS5ph4WPNEdwUl20qUAf4Rza39Si");
define('HOT_WALLET', "0xB5928fA57dCe26dc23AE193F5E2Af4Fc2FdeaDB8");
define('FORWARD_WALLET', "0x411A467Da7f60D42F41C9FC96bCA3c5D81764aa2");




define('CORP', 'SmartGateway');
$SGQUERY = 'ttlk';
define('CONTROLLER', 'Page');
define('METODO', 'index');
define('URI', '/');


define('HOST', 'localhost');
define('USER', 'u583600167_smartguser');
define('PASS', '$fcV3~n7G#');
define('DBNAME', 'u583600167_smartgateway');
