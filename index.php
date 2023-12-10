<?php
ob_start();
header("Access-Control-Allow-Origin: *");

require './core/Config.php';
require './vendor/autoload.php';

use Core\ConfigController as Home;

$Url = new Home();
$Url->carregar();
exit;
