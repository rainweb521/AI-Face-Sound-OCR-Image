<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>语音合成</title>
    <link rel="stylesheet" href="/public/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/public/assets/css/admin.css">
    <link rel="stylesheet" href="/public/assets/css/app.css">
    <link rel="stylesheet" href="/public/assets/css/amazeui.flat.min.css">
    <script src="/public/assets/js/amazeui.ie8polyfill.min.js"></script>
    <script src="/public/assets/js/amazeui.min.js"></script>
    <script src="/public/assets/js/amazeui.widgets.helper.min.js"></script>
    <script src="/public/assets/js/app.js"></script>
    <script src="/public/assets/js/handlebars.min.js"></script>

    <link rel="stylesheet" type="text/css" href="public/css/reset.css" />
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        body {
            font-size: 12px;
            margin: 0px;
            text-align:center;
            vertical-align:middle;
            overflow-y: auto;
        }
    </style>
</head>
<body >
<!--<div align="left" style="margin-top: 2%;margin-left: 2%;font-size: 30px;">-->
<!--    <button class="am-btn am-btn-default am-btn-xl" onclick="location.href='index.html';">返回</button>-->
<!--</div>-->
<?php require ('header.php');?>
<main class="cd-main-content">
    <h1 align="center" style="margin-top: 3%;margin-bottom: -2%;font-size: 30px;">语音合成功能</h1>
    <div align="center" style="margin-top: 5%;">
        <form enctype="multipart/form-data" method="post" action="face_detect.php" id="myform">
            <div class="am-form-group am-form-file">


                <!--    <input type="text" value="0" name="tip">-->
            </div>
            <!--        <button type="submit" class="am-btn am-btn-sm">提交</button>-->
        </form>
        <hr/>
    </div>
    <div style="width: 100%;">
        <div align="center" style="width: 50%;float: left;">
            <div class="am-form-group" style="width: 70%;">
                <form class="am-form" method="post" action="sound.php" id="myform">
                    <fieldset>
<!--                <label for="doc-ta-1">文本域</label>-->
                        <div >
                        <div style="width: 30%;float: left;margin-right: 1%;">
                            <select id="per" name="per" data-am-selected="{btnWidth: '20%', btnSize: 'xs', btnStyle: 'secondary'}">
                                <option value="0">选择男女</option>
                                <option value="0">女声</option>
                                <option value="1">男声</option>
                            </select>
                        </div>
                        <div style="width: 30%;float: left;margin-right: 1%;">
                            <select id="pit" name="pit" data-am-selected="{btnWidth: '20%', btnSize: 'xs', btnStyle: 'secondary'}">
                                <option value="5">选择音调</option>
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="6">5</option>
                                <option value="7">7</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                        <div style="width: 30%;float: left;">
                            <select id="spd" name="spd" data-am-selected="{btnWidth: '20%', btnSize: 'xs', btnStyle: 'secondary'}">
                                <option value="5">选择语速</option>
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="6">5</option>
                                <option value="7">7</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                            <br><br><hr>
                    </div>
                <textarea class="" name="text" rows="5"  id="doc-ta-1"></textarea>
                        <br>
                        <p><button type="submit" class="am-btn am-btn-secondary am-btn-block">提交</button></p>
                    </fieldset></form>
            </div>
        </div>
    <?php

    if(!empty($_POST['text'])){
        $text = ($_POST['text']);
        $per = ($_POST['per']);
        $spd = ($_POST['spd']);
        $pit = ($_POST['pit']);
//        echo $text;
//    echo "321342314123";
//    $data['g_addtime'] = date("Y-m-d");
//        onchange="document.getElementById('myform').submit();"                                    echo date("Y-m-d");
        require_once 'config/rain_function.php';
        $function = new rain_function();
        $text = $function->str_handling($text);
        $result = $function->sound($text,$per,$spd,$pit);
//    var_dump($result);
        ?>
     <script>
         document.getElementById('doc-ta-1').value = '<?php echo $text;?>';
         document.getElementById('per').value = '<?php echo $per;?>';
         document.getElementById('spd').value = '<?php echo $spd;?>';
         document.getElementById('pit').value = '<?php echo $pit;?>';
     </script>
            <div align="center" style="width: 40%;height:1000px; float: left;margin-bottom: 10%;">

                <audio controls="controls">
                    <source src="<?php echo $result;?>" type="audio/mpeg">
                    您的浏览器不支持音频元素。
                </audio>

            </div>


        <?php
    }else{
        ?> <?php
    }
    ?>
        </div>
</main>
<script src="public/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="public/js/modernizr-custom.js"></script>
<script src="public/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>

