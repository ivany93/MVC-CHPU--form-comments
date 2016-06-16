<?php

/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 10.06.2016
 * Time: 15:24
 */
class Users
{

    public static function getUserRole ($login,$password){
        if(!isset($_SESSION)){ session_start(); }
        $db = Db::getConnection();
            $result = $db->prepare('SELECT * FROM user WHERE login =:login  AND password=:password');
            $result->execute(array(":login"=>$login, ":password"=>$password));
            $user = $result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['login']= $user['login'];
        $_SESSION['password']= $user['password'];
        $_SESSION['role']= $user['role'];
            return $user;

    }

    public static function userCheck ($login, $password){

    }



}