<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>文字识别</title>
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
<h1 align="center" style="margin-top: 3%;margin-bottom: -2%;font-size: 30px;">文字识别---通用文字识别功能</h1>
<div align="center" style="margin-top: 5%;">
    <form enctype="multipart/form-data" method="post" action="ocr_all.php" id="myform">
<div class="am-form-group am-form-file">

    <button type="button" class="am-btn am-btn-default am-btn-sm">
        <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>

        <input type="file" name="image" onchange="document.getElementById('myform').submit();"  value=""  multiple>&nbsp;&nbsp;


<!--    <input type="text" value="0" name="tip">-->
</div>
<!--        <button type="submit" class="am-btn am-btn-sm">提交</button>-->
    </form>

</div>

<?php
//echo $_SERVER["REQUEST_URI"];
if(!empty($_FILES['image'])){
    $file = $_FILES['image'];
//    echo "321342314123";
//    $data['g_addtime'] = date("Y-m-d");
//        onchange="document.getElementById('myform').submit();"                                    echo date("Y-m-d");
    require_once 'config/rain_function.php';
    $function = new rain_function();
    $image_src = $function->upload_file($file);
//    echo $image_src;exit();
    if ($image_src=='0'){?> <h1 align='center' style='color: red;font-size: 50px;'>上传文件格式不对！</h1>
    <?php }else{
    $result = $function->ocr_recognition($image_src);
//    var_dump($result);
    ?>
    <div style="width: 100%;" align="left">
        <div align="center" style="width: 50%;float: left;">
            <img src="<?php echo $image_src;?>" width="80%" height="80%">
        </div>
        <div align="left" style="width: 45%;height:1000px; float: left;margin-bottom: 10%;">
            <table class="am-table am-table-bordered am-table-centered" >
                <thead>
                <tr>
                    <th width="23%">识别行数</th>
                    <th><?php echo $result['words_result_num'];?></th>
                </tr>
                </thead>
            </table>

                <?php
                    foreach ($result['words_result'] as $line){
                ?>
<!--            <table align="left" class="am-table am-table-bordered am-table-centered">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th>人脸属性</th>-->
<!--                    <th>值</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody align="left">-->
<!--                        <tr align="left">-->
<!--                            <td>颜值分数</td>-->
<!--                            <td align="left">-->
                                <?php echo $line['words'];?><br><br>
<!--                            </td>-->
<!--                        </tr>-->

<!--                </tbody>-->
<!--            </table>-->
                <?php }?>


        </div>
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