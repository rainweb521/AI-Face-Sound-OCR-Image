<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AI-人工智能</title>
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
<body>
<?php require ('header.php');?>

<main class="cd-main-content">
    <div align="center" style="width: 50%;margin: auto;margin-top: 2%;">
        <h1 style="font-size: 30px;margin-bottom: 1%;">Rain-基于百度人工智能接口的二次开发<br>
            <span style="font-size: 20px;">手机页面请点击右上方菜单</span>
        </h1>
        <button type="button" onclick="location.href='face_detect.php';" class="am-btn am-btn-primary am-btn-block">人脸检测</button>
        <br>
        <button type="button" onclick="location.href='face_compare.php';" class="am-btn am-btn-warning am-btn-block">人脸对比</button>
        <br>
        <button type="button" onclick="location.href='sound.php';" class="am-btn am-btn-success am-btn-block">语音合成</button>
        <br>
        <button type="button" onclick="location.href='image_identification.php?type=1';" class="am-btn am-btn-secondary am-btn-block">动物识别</button>
        <br>
        <button type="button" onclick="location.href='image_identification.php?type=2';" class="am-btn am-btn-danger am-btn-block">植物识别</button>
        <br>
        <button type="button" onclick="location.href='image_identification.php?type=3';" class="am-btn am-btn-primary am-btn-block">车辆识别</button>
        <br>
        <button type="button" onclick="location.href='image_identification.php?type=4';" class="am-btn am-btn-warning am-btn-block">Logo识别</button>
        <br>
        <button type="button" onclick="location.href='ocr_all.php';" class="am-btn am-btn-success am-btn-block">文字识别</button>
        <br>
        <button type="button" onclick="location.href='text_affections.php';" class="am-btn am-btn-secondary am-btn-block">情感分析</button>
        <br>
        <button type="button" onclick="location.href='text_similarity.php';" class="am-btn am-btn-danger am-btn-block">短文本相似度</button>
        <br>
        <button type="button" class="am-btn am-btn-default am-btn-block">更多功能正在开发....</button>
    </div>
</main>
<script src="public/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="public/js/modernizr-custom.js"></script>
<script src="public/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>

