<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>人脸对比</title>
    <link rel="stylesheet" href="/public/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/public/assets/css/admin.css">
    <link rel="stylesheet" href="/public/assets/css/app.css">
    <link rel="stylesheet" href="/public/assets/css/amazeui.flat.min.css">
    <script src="http://cos.rain1024.com/blog/static/assets/js/amazeui.ie8polyfill.min.js"></script>
    <script src="http://cos.rain1024.com/blog/static/assets/js/amazeui.min.js"></script>
    <script src="http://cos.rain1024.com/blog/static/assets/js/amazeui.widgets.helper.min.js"></script>
    <script src="http://cos.rain1024.com/blog/static/assets/js/app.js"></script>
    <script src="http://cos.rain1024.com/blog/static/assets/js/handlebars.min.js"></script>

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
<?php require ('header.php');
require_once 'config/rain_function.php';
$function = new rain_function();
$use_num = $function->use_num('2');?>
<main class="cd-main-content">
<!--<div align="left" style="margin-top: 2%;margin-left: 2%;font-size: 30px;">-->
<!--    <button class="am-btn am-btn-default am-btn-xl" onclick="location.href='index.php';">返回</button>-->
<!--</div>-->
<h1 align="center" style="margin-top: 3%;margin-bottom: -2%;font-size: 30px;">人脸识别---人脸对比功能<br>
    <span style="font-size: 17px;">对比两张人脸的相似度，并给出相似度评分，从而判断是否同一个人</span><br>
    <span style="font-size: 20px;" id="use_num">（今日剩余使用次数<?php echo $use_num;?>）</span></h1>
    <?php if ($use_num==0){?>
        <h1 align="center" style="margin-top: 8%;font-size: 35px;">今日次数以及使用完毕，请明日再来</h1>
    <?php }else{?>
<div align="center" style="margin-top: 5%;">
    <form enctype="multipart/form-data" method="post" action="face_compare.php" id="myform">

        <div class="am-form-group am-form-file" style="float: left;margin-left: 20%;">
            <button type="button" class="am-btn am-btn-default am-btn-sm">
                <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
            <span style="color: red;font-size: 20px;display: none;" id="state1">已选择</span>
                <input type="file" name="image1" onchange="document.getElementById('state1').style.display = 'block';"   value=""  multiple>&nbsp;&nbsp;
        </div>
        <div class="am-form-group am-form-file" style="float: right;margin-right: 20%;">
            <button type="button" class="am-btn am-btn-default am-btn-sm">
                <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
            <span style="color: red;font-size: 20px;display: none;" id="state2">已选择</span>
            <input type="file" name="image2" onchange="document.getElementById('state2').style.display = 'block';"  value=""  multiple>&nbsp;&nbsp;
        </div>
        <div>
        <button type="submit" class="am-btn am-btn-primary">提交</button>
        </div>
    </form>
</div>
    <?php }?>
<?php

if(!empty($_FILES['image1'])){
    $file1 = $_FILES['image1'];
    $file2 = $_FILES['image2'];
//    echo "321342314123";
//    $data['g_addtime'] = date("Y-m-d");
//        onchange="document.getElementById('myform').submit();"                                    echo date("Y-m-d");
    $image_src1 = $function->upload_file($file1);
    $image_src2 = $function->upload_file($file2);
    if ($image_src1=='0'||$image_src2=='0'){?> <h1 align='center' style='color: red;font-size: 50px;'>上传文件格式不对！</h1>
    <?php }else{
    $result = $function->face($image_src1,$image_src2,1);
    $use_num = $function->use_num('2');
    //    var_dump($result);
    ?>
        <script>document.getElementById('use_num').innerHTML = '（今日剩余使用次数<?php echo $use_num;?>）';</script>
    <div align="center" style="width: 50%;margin: auto;">
        <table class="am-table am-table-bordered am-table-centered">
            <thead>
            <tr class="am-danger">
                <th width="23%">相似指数</th>
                <th><?php echo $result['result'][0]['score'];?></th>
            </tr>
            </thead>
        </table>
    </div>
    <div style="width: 100%;">

        <div align="center" style="width: 50%;float: left;">
            <img src="<?php echo $image_src1;?>" width="60%" height="60%">
        </div>
        <div align="center" style="width: 50%;float: right;">
            <img src="<?php echo $image_src2;?>" width="60%" height="60%">
        </div>
    </div>

    <?php
}}else{
    ?> <?php
}
?>
</main>
<script src="http://cos.rain1024.com/blog/static/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="http://cos.rain1024.com/blog/static/js/modernizr-custom.js"></script>
<script src="http://cos.rain1024.com/blog/static/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>