<?php

/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 08.06.2016
 * Time: 0:26
 */
include_once ROOT . '/models/Comments.php';
class CommentsController
{


    public function actionIndex(){

        $newsList = array();
        $newsList = Comments::getListComments(2);
        require_once(ROOT . '/view/comments/index.php');
        return true;
    }

    public function actionPublisher ($id,$status){

        Comments::updateComment($id,$status);
        header('Location:/admin/index');
    }

    public function actionUpdateAdmin ($id,$status){

        Comments::updateCommentAdmin($_POST['id'],$_POST['name'],$_POST['email'],$_POST['text']);
    }

    public function actionAdd()
    {
            $imgUrl = null;
            $path = 'tmp/';
            $tmp_path = '';
            $types = array('image/gif', 'image/png', 'image/jpeg');
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['picture']['size']>0) {
                print_r($_FILES['picture']);
                if (!in_array($_FILES['picture']['type'], $types)){
                    header('Location:/comments/error');
                }
                $nameImg = Comments::resize($_FILES['picture']);
                $imgUrl = $nameImg;
                if (!@copy($tmp_path . $nameImg, $path . $nameImg))
                    header('Location:/comments/error');
                else
                    header('Location:/');
                unlink($tmp_path . $nameImg);


            }

        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['text'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $text = $_POST['text'];
            $img = $imgUrl;
            Comments::addNewComment($name, $email, $text, $img);
            unset($_POST['text']);
            unset($_POST['email']);
            unset($_POST['name']);

        }
    }

    public function actionPull($edit_id){
        $OneComment = Comments::getCommentsItemById($edit_id);
        $OneCommentJson = json_encode($OneComment);
        echo $OneCommentJson;
        return $OneCommentJson;
    }

    public function actionSort($sort){
        $newsList = array();
        $newsList = Comments::getListComments($sort);
        require_once(ROOT . '/view/comments/index.php');
        return true;
    }


    public function actionError (){
        require_once (ROOT.'/view/comments/error.php');
    }
}