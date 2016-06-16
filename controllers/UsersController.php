<?php

/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 10.06.2016
 * Time: 15:32
 */
include_once ROOT."/models/Users.php";
include_once ROOT."/models/Comments.php";
if(!isset($_SESSION)){ session_start(); }
class UsersController
{

    public function actionIndex(){

            if(isset($_SESSION['role'])){
            if($_SESSION['role']==1){
                    $newsList = array();
                    $newsList = Comments::getListCommentsAdmin();
                    require_once(ROOT . '/boss/index.php');
                }
            }else{
                require_once(ROOT . '/boss/autf-form.php');
            }
        return true;

}


    public function actionLogin(){
        if(isset($_POST['login']) && isset($_POST['password'])){
            Users::getUserRole($_POST['login'],$_POST['password']);
        }else{
            require_once(ROOT . '/boss/autf-form.php');
        }
        if(isset($_SESSION['role'])){
            if($_SESSION['role']==1) {
                header('location: admin/index');
            }
        }else{
            require_once(ROOT . '/boss/autf-form.php');
        }
        return true;
    }



    public function actionExit(){
        session_unset();
        session_destroy();
        header('Location: /comments');
    }

}