<?php
ob_start();
/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 08.06.2016
 * Time: 11:23
 */
class Comments {

    public static function getCommentsItemById ($id){
        $id = intval($id);
        if($id){
            $db = Db::getConnection();
            $result = $db->query('SELECT id,name,date,email,status,text FROM comments WHERE id='.$id);
            $newsItem = $result->fetch(PDO::FETCH_ASSOC);
            return $newsItem;
        }
    }


    public static function addNewComment ($name,$email,$text,$img){
        $db = Db::getConnection();
        $sql= "INSERT  INTO `comments`(`name`,`email`, `text`,`img`) VALUES (:name,:email,:text,:img)";
        $result = $db->prepare($sql);
        $result->execute(array(":name"=>$name,":email"=>$email,":text"=>$text,":img"=>$img));
    }

    public static function updateComment ($id,$status){
        if($status==0){
            $newStatus = 1;
        }else{
            $newStatus = 0;
        }
        $db = Db::getConnection();
        $sql= "UPDATE `comments` set status =:status WHERE id=:id";
        $result = $db->prepare($sql);
        $result->execute(array(":status"=>$newStatus,":id"=>$id));
    }

    public static function updateCommentAdmin ($id,$name,$email,$text){
        $db = Db::getConnection();
        $sql= "UPDATE `comments` set name =:name, email=:email, text=:text, editAdmin=:editAdmin WHERE id=:id";
        $result = $db->prepare($sql);
        $result->execute(array(":name"=>$name,":email"=> $email,":text"=>$text,":editAdmin"=>1, ":id"=>$id));
    }

    public static function getListComments ($sort){

        switch($sort){
            case('0'): $sort = "name"; break;
            case('1'): $sort = "email"; break;
            case('2'): $sort = "date"; break;
            default: $sort = "date";break;
        }
        $db = Db::getConnection();
        $newList = array();
        $result = $db->query("SELECT * FROM comments WHERE status=1 ORDER BY $sort DESC LIMIT 10");
        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $newList[$i]['id'] = $row['id'];
            $newList[$i]['title'] = $row['name'];
            $newList[$i]['date'] = $row['date'];
            $newList[$i]['email'] = $row['email'];
            $newList[$i]['text'] = $row['text'];
            $newList[$i]['status'] = $row['status'];
            $newList[$i]['editAdmin'] = $row['editAdmin'];
            $newList[$i]['img'] = $row['img'];

            $i++;
        }
        return $newList;
    }

    public static function getListCommentsAdmin (){
        $db = Db::getConnection();
        $newList = array();
        $result = $db->query('SELECT * FROM comments ORDER BY date DESC LIMIT 10');
        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $newList[$i]['id'] = $row['id'];
            $newList[$i]['title'] = $row['name'];
            $newList[$i]['date'] = $row['date'];
            $newList[$i]['email'] = $row['email'];
            $newList[$i]['text'] = $row['text'];
            $newList[$i]['editAdmin'] = $row['editAdmin'];
            $newList[$i]['status'] = $row['status'];
            $newList[$i]['img'] = $row['img'];
            $i++;
        }
        return $newList;
    }

    public static function resize($file, $type = 1, $rotate = null, $quality = null)
    {
        global $tmp_path;
        $max_thumb_size = 320;
        $max_size = 600;
        if ($quality == null)
            $quality = 75;
        if ($file['type'] == 'image/jpeg')
            $source = imagecreatefromjpeg($file['tmp_name']);
        elseif ($file['type'] == 'image/png')
            $source = imagecreatefrompng($file['tmp_name']);
        elseif ($file['type'] == 'image/gif')
            $source = imagecreatefromgif($file['tmp_name']);
        else
            return false;
        if ($rotate != null)
            $src = imagerotate($source, $rotate, 0);
        else
            $src = $source;
        $w_src = imagesx($src);
        $h_src = imagesy($src);
        if ($type == 1)
            $w = $max_thumb_size;
        elseif ($type == 2)
            $w = $max_size;
        if ($w_src > $w)
        {
            $ratio = $w_src/$w;
            $w_dest = round($w_src/$ratio);
            $h_dest = round($h_src/$ratio);
            $dest = imagecreatetruecolor($w_dest, $h_dest);
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
            imagejpeg($dest, $tmp_path . $file['name'], $quality);
            imagedestroy($dest);
            imagedestroy($src);
            return $file['name'];
        }
        else
        {
            imagejpeg($src, $tmp_path . $file['name'], $quality);
            imagedestroy($src);
            return $file['name'];
        }
    }


    public static function imageUpload (){

    }
}
ob_flush();