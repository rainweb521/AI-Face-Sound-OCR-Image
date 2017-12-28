<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图像识别</title>
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
<?php require ('header.php');?>
<main class="cd-main-content">
<!--<div align="left" style="margin-top: 2%;margin-left: 2%;font-size: 30px;">-->
<!--    <button class="am-btn am-btn-default am-btn-xl" onclick="location.href='index.php';">返回</button>-->
<!--</div>-->
<h1 align="center" style="margin-top: 3%;margin-bottom: -2%;font-size: 30px;">图像识别---
    <?php
    if (!empty($_GET['type'])){
        $type = $_GET['type'];
    }else{
        $type = 1;
    }
    if ($type==2){echo "植物";} elseif ($type==3){echo "车辆";}elseif ($type==4){echo "Logo";}else{echo "动物";}

        ?>识别功能</h1>
<div align="center" style="margin-top: 5%;">
    <form enctype="multipart/form-data" method="post" action="image_identification.php?type=<?php echo $type;?>" id="myform">
<div class="am-form-group am-form-file">
    <button type="button" class="am-btn am-btn-default am-btn-sm">
        <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>

        <input type="file" name="image" onchange="document.getElementById('myform').submit();"  value=""  multiple>&nbsp;&nbsp;


<!--    <input type="text" value="0" name="tip">-->
</div>
<!--        <button type="submit" class="am-btn am-btn-sm">提交</button>-->
    </form>
<hr/>
</div>
<?php

if(!empty($_FILES['image'])){
    $file = $_FILES['image'];
//    echo "321342314123";
//    $data['g_addtime'] = date("Y-m-d");
//        onchange="document.getElementById('myform').submit();"                                    echo date("Y-m-d");
    require_once 'config/rain_function.php';
    $function = new rain_function();
    $image_src = $function->upload_file($file);
if ($image_src=='0'){?> <h1 align='center' style='color: red;font-size: 50px;'>上传文件格式不对！</h1>
<?php }else{
    $result = $function->image_identification($image_src,$type);
//    var_dump($result);
    ?>
    <div style="width: 100%;" align="left">
        <div align="center" style="width: 50%;float: left;">
            <img src="<?php echo $image_src;?>" width="60%" height="60%">
        </div>
        <?php if ($type==4){?>
            <div align="left" style="width: 45%;height:1000px; float: left;margin-bottom: 10%;">
                <table class="am-table am-table-bordered am-table-centered" >
                    <thead>
                    <tr>
                        <th width="23%">识别数</th>
                        <th><?php echo $result['result_num'];?></th>
                    </tr>
                    </thead>
                </table>
                <table align="left" class="am-table am-table-bordered am-table-centered">
                    <thead>
                    <tr>
                        <th>商标名称</th>
                        <th>置信度</th>
                    </tr>
                    </thead> <tbody align="left">
                    <?php
                    foreach ($result['result'] as $line){
                        ?>
                        <tr >
                            <td><?php echo $line['name'];?></td>
                            <td >
                                <?php echo $line['probability'];?>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>  </table>

            </div>
        <?php }else{?>
            <div align="left" style="width: 45%;height:1000px; float: left;margin-bottom: 10%;">
                <table align="left" class="am-table am-table-bordered am-table-centered">
                    <thead>
                    <tr>
                        <th>动物名称</th>
                        <th>置信度</th>
                    </tr>
                    </thead> <tbody align="left">
                    <?php
                    foreach ($result['result'] as $line){
                        ?>
                        <tr >
                            <td><?php echo $line['name'];?></td>
                            <td >
                                <?php echo $line['score'];?>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>  </table>

            </div>
        <?php }?>

    </div>

    <?php
}}else{
    ?> <?php
}
?>
</main>
<script src="public/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="public/js/modernizr-custom.js"></script>
<script src="public/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>