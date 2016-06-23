<?php
/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 10.06.2016
 * Time: 15:21
 */
?>
<html>
<head>
    <link rel="stylesheet" href="../resource/bootstrap/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="../resource/bootstrap/js/bootstrap.js"></script>
<!--    <script type="text/javascript" src="../resource/js/jquery-1.5.2.min.js"></script>-->
</head>
<body>


<label>Страница Админа</label>
<a class="btn btn-danger" href="/admin/exit">Выход</a>
<div class="container" align="center" style="background-color: #f7f7f7">
    <div class="row">
        <div class="span2">img</div>
        <div class="span1">Дата</div>
        <div class="span2">Имя</div>
        <div class="span2">Текст</div>
        <div class="span2">email </div>
        <div class="span1">Статус публикации </div>
        <div class="span1">Статус ред. </div>
        </div>
    </div>
<br>
    <?php foreach($newsList as $one){?>

<div class="container" align="center">
    <div class="row">
        <div class="span2"><img src="../tmp/<?= $one['img']?>" width="100px"></div>
                <div class="span1"><?=$one['date']?></div>
                <div class="span2"><?= $one['title'] ?></div>
                <div class="span2"><?=$one['text']?></div>
                <div class="span2"><?= $one['email'] ?></div>
                <div class="span1"><?php if($one['status'] ==1){echo "Опубл.";}else{echo "не опуб.";}?></div>
                <div class="span1">  <?php if($one['editAdmin'] ==1){echo "Ред.";}else{echo "Оригинал";}?></div>
                <div class="span1">

                    <a class=" btn-small btn-success" href="/comments/publisher/<?=$one['id']?>/<?= $one['status'] ?>">
                        <?php if($one['status'] ==0){echo "Показать";}else{echo "Скрыть";}?></a>

                    <button class="btn-small btn-warning" onclick="editComment(<?=$one['id']?>)"> Редактировать </button>
                </div>

        <br>

    </div>
</div>
        <hr>
<?php } ?>
<div id="editCommentModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <input id="id" type="hidden" >
            <label>Имя</label>
            <input  type="text" name="name" id="nameEdit" autofocus="true">
            <br>
            <label>Email</label>
            <input type="email" name="email" id="emailEdit">

            <label>Текст</label>
            <br>
            <textarea  class="form-control" rows="5" name="text" id="textEdit"> </textarea>
            <br>
            <button type="submit" class="btn-success" id="buttonSubmit"> Обновить</button>
            <button type="submit" class="btn-danger" id="buttonCancel"> Отменить</button>
            <br>
        </div>

    </div>
</div>
<script type="text/javascript">

    function editComment (edit_id){
        $.ajax({
            url:"/comments/pull/"+edit_id,
            type:"POST",
            data:({edit_id: edit_id}),
            dataType:"json",
            success: answer
        });
    }

    function answer(data){
        report = JSON.stringify(data);
        console.log(''+data.email);
        $('#id').val(data.id);
        $('#nameEdit').val(data.name);
        $('#emailEdit').val(data.email);
        $('#textEdit').val(data.text);
        $('#editCommentModal').modal('show');

    }

    function updateComment(){
        $('#editCommentModal').modal('hide');

        alert('Обновленно!');
    }

    $(document).ready( function() {
        $('#buttonCancel').bind('click', function(){
            $('#editCommentModal').modal('hide');
        });

        $('#buttonSubmit').bind('click', function(){
            $.ajax({
                url:"/comments/updateAdmin",
                type:"POST",
                data:({id: $('#id').val(), name:  $('#nameEdit').val(),email:  $('#emailEdit').val(),text:  $('#textEdit').val()}),
                success: updateComment
            });
        });

    });

</script>
</body>
</html>