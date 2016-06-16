<?php
/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 07.06.2016
 * Time: 23:05
 */

// отображение ошибок
ini_set('display_errors',1);
error_reporting(E_ALL);

// подключение файлов системы

define('ROOT', dirname( __FILE__));
require_once (ROOT.'/components/Router.php');
require_once (ROOT.'/components/Db.php');



 $router = new Router();
$router->run();