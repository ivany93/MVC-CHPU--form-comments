<?php

/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 08.06.2016
 * Time: 18:27
 */
class Db
{
public static function getConnection (){
    $paramsPath = ROOT.'/config/db_params.php';
    $params = include ($paramsPath);

    $db = new PDO(("mysql:host={$params['host']};dbname={$params['dbname']}"),$params['user'],$params['password']);
    return $db;
}
}