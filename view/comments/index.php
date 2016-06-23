<?php
/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 09.06.2016
 * Time: 15:02
 */

?>
<html>
<head>
    <link rel="stylesheet" href="../../resource/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../resource/css/style.css">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="../../resource/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../resource/js/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="../../resource/js/jquery.validate.min.js"></script>
</head>
<body>


<div class="container" >
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Сортировать по: </button>
        <ul class="dropdown-menu">
            <li><a href="/comments/sort/0" id="sort0">по автору</a></li>
            <li><a href="/comments/sort/1"  id="sort1">email</a></li>
            <li><a href="/comments/sort/2" id="sort2">дате добавления</a></li>
        </ul>
    </div>
    <br>
        <br>
    <?php foreach($newsList as $one){?>
        <div style="background-color: #f3f9e4" align="center">
            <div class="row">
                <div class="span3"><img src="../../tmp/<?= $one['img']?>"></div>
                <div class="span1"><?= $one['title'] ?></div>
                <div class="span6"><?=$one['text']?></div>
                <div class="span1"><?=$one['date']?></div>
                <div class="span1">  <?php if($one['editAdmin'] ==1){echo "Ред.";}else{ echo "";}?></div>

                <br>
                <br>
            </div>
        </div>
        <br>
        <br>
    <?php } ?>
<div align="center">

<form action="../../comments/add" method="post" id="formcomment" enctype=multipart/form-data >
            <label>Имя</label>
            <input id="name" type="text" name="name">

            <label>Email</label>
            <input type="email" name="email" id="email">

            <label>Текст</label>
            <textarea  class="form-control" rows="5" name="text" id="text"> </textarea>
            <br>
    <input type=file name=picture id="picture">
    <br>
   <p> <button id="prevView" class="btn btn-primary btn-mini" data-toggle="modal" data-target="#myModal"> Посмотреть  </button></p>
    <button type="submit" class="btn-success" id="buttonSubmit"> Отправить</button>

</form>

</div>
</div>

    </div>
</div>


<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container" >
            <div class="row">
                <div class="span2" id="authorPrevView"> </div>
                <div class="span4" id="textPrevView"></div>
                <div class="span1" id="dataPrevView"> </div>
                <br>
                <br>
            </div>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#formcomment').validate({

            rules:{

                name:{
                    required: true,
                    minlength: 2
                },

                email:{
                    required: true,
                    email: true
                },
                text:{
                    required: true
                }
            },

            messages:{

                name:{
                    required: "Это поле обязательно для заполнения",
                    minlength: "Логин должен быть минимум 2 символа"
                },

                email:{
                    required: "Это поле обязательно для заполнения",
                    email: "не верный email"
                },
                text:{
                    required: "Это поле обязательно для заполнения"
                }

            }

        });
        Data = new Date();
        $('#prevView').bind('click', function(){
            $('#authorPrevView').text($('#name').val());
            $('#textPrevView').text($('#text').val());
            $('#dataPrevView').html(Data.getFullYear()+"-"+
                Data.getMonth()+'-'+Data.getDate()+":"+Data.getHours()+":" +
                ""+Data.getMinutes()+':'+Data.getSeconds());
            $('#myModal').modal('show');

        });
    });
</script>
</body>
</html>