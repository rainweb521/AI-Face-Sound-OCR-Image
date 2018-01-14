<!DOCTYPE html>
<html>
<head>
    <title>我要报名</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- loading mui -->
    <link rel="stylesheet" type="text/css" href="/public/mobile/css/mui.min.css">
    <!-- custorm style -->
    <link rel="stylesheet" type="text/css" href="/public/mobile/css/style.css">
    <!-- 自定义样式 -->
    <style type="text/css">
        .mui-preview-image.mui-fullscreen {
            position: fixed;
            z-index: 20;
            background-color: #000;
        }
        .mui-preview-header,
        .mui-preview-footer {
            position: absolute;
            width: 100%;
            left: 0;
            z-index: 10;
        }
        .mui-preview-header {
            height: 44px;
            top: 0;
        }
        .mui-preview-footer {
            height: 50px;
            bottom: 0px;
        }
        .mui-preview-header .mui-preview-indicator {
            display: block;
            line-height: 25px;
            color: #fff;
            text-align: center;
            margin: 15px auto 4;
            width: 70px;
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 12px;
            font-size: 16px;
        }
        .mui-preview-image {
            display: none;
            -webkit-animation-duration: 0.5s;
            animation-duration: 0.5s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }
        .mui-preview-image.mui-preview-in {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }
        .mui-preview-image.mui-preview-out {
            background: none;
            -webkit-animation-name: fadeOut;
            animation-name: fadeOut;
        }
        .mui-preview-image.mui-preview-out .mui-preview-header,
        .mui-preview-image.mui-preview-out .mui-preview-footer {
            display: none;
        }
        .mui-zoom-scroller {
            position: absolute;
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            -webkit-backface-visibility: hidden;
        }
        .mui-zoom {
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
        }
        .mui-slider .mui-slider-group .mui-slider-item img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 100%;
        }
        .mui-android-4-1 .mui-slider .mui-slider-group .mui-slider-item img {
            width: 100%;
        }
        .mui-android-4-1 .mui-slider.mui-preview-image .mui-slider-group .mui-slider-item {
            display: inline-table;
        }
        .mui-android-4-1 .mui-slider.mui-preview-image .mui-zoom-scroller img {
            display: table-cell;
            vertical-align: middle;
        }
        .mui-preview-loading {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: none;
        }
        .mui-preview-loading.mui-active {
            display: block;
        }
        .mui-preview-loading .mui-spinner-white {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -25px;
            margin-top: -25px;
            height: 50px;
            width: 50px;
        }
        .mui-preview-image img.mui-transitioning {
            -webkit-transition: -webkit-transform 0.5s ease, opacity 0.5s ease;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }
        @-webkit-keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        @-webkit-keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
        img {
            max-width: 100%;
            height: auto;
        }

        .a-upload {
            padding: 4px 10px;
            margin-top: 5px;
            height: 40px;
            line-height: 20px;
            position: relative;
            cursor: pointer;
            color: black;
            /*background: #fafafa;*/
            /*border: 1px solid #ddd;*/
            border-radius: 4px;
            overflow: hidden;
            display: inline-block;
            *display: inline;
            *zoom: 1
        }

        .a-upload  input {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
            filter: alpha(opacity=0);
            cursor: pointer
        }

        .a-upload:hover {
            color: #444;
            /*background: #eee;*/
            /*border-color: #ccc;*/
            text-decoration: none
        }
    </style>
</head>
<body>
<!-- 导航栏 -->
<header id="header" class="mui-bar mui-bar-nav">
    <h1 class="mui-title" >驾驶证查询</h1>
    <a class="mui-action-back mui-btn mui-btn-blue mui-btn-link mui-btn-nav mui-pull-left" href="javascript:history.go(-1)"><span class="mui-icon mui-icon-left-nav"></span></a>
    <a class="mui-icon mui-icon-bars mui-pull-right" href="#topPopover"></a>

</header>
<!-- 右上角弹出菜单 -->
<div id="topPopover" class="mui-popover">
    <div class="mui-popover-arrow"></div>
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <ul class="mui-table-view">
                <li class="mui-table-view-cell">
                    <a href="query.html">我要查询</a>
                </li>
                <li class="mui-table-view-cell"><a href="vote.html">我要投票</a>
                </li>
                <li class="mui-table-view-cell"><a href="rate.html">我要评价</a>
                </li>
                <li class="mui-table-view-cell"><a href="enroll.html">我要报名</a>
                </li>
                <li class="mui-table-view-cell"><a href="payment.html">我要缴费</a>
                </li>
                <li class="mui-table-view-cell"><a href="personCenter.html">个人中心</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
<!-- 主内容部分 -->
<div class="content">

    <section class="xueqi">
        <div class="class">
            <form enctype="multipart/form-data" method="post" action="mobil.php" id="myform">
            <a href="javascript:;" class="a-upload">
                <input type="file" name="image" onchange="document.getElementById('myform').submit();"  value=""  multiple>点击这里上传文件
            </a>
            </form>
        </div>
    </section>

    <?php
    //echo $_SERVER["REQUEST_URI"];
    if(!empty($_FILES['image'])){
        require_once 'config/rain_function.php';
        $function = new rain_function();
        $file = $_FILES['image'];
        $image_src = $function->upload_file($file);
//    echo $image_src;exit();
        if ($image_src=='0'){?> <h1 align='center' style='color: red;font-size: 50px;'>上传文件格式不对！</h1>
        <?php }else{
            $result = $function->ocr_recognition($image_src,2);
            $keys = array_keys($result['words_result']);
            $values = (array_values($result['words_result']));
//            var_dump($values);exit()/**/;
//                var_dump(array_keys($line));

        ?>
            <section class="enroll">
                <!--        <h5>请看下面的图片并提交您的联系方式</h5>-->
                <img src="<?php echo $image_src;?>" data-preview-src data-preview-group="1">
                <form class="mui-input-group">
                    <?php for ($i=0;$i<10;$i++) { ?>
                    <div class="mui-input-row">
                        <label onclick="sound('<?php echo $keys[$i];?>')"><?php echo $keys[$i];?></label>
                        <input readOnly="true" type="text" class="mui-input-clear" onclick="sound('<?php echo $values[$i]['words'];?>')" value="<?php echo $values[$i]['words'];?>"><span class="mui-icon mui-icon-clear mui-hidden"></span>
                    </div>
                <?php }?>
                    <!--            <div class="mui-button-row">-->
                    <!--                <button type="button" class="mui-btn mui-btn-primary" onclick="return false;">提交</button>&nbsp;&nbsp;-->
                    <!--                <button type="button" class="mui-btn mui-btn-danger" onclick="return false;">取消</button>-->
                    <!--            </div>-->
                </form>
            </section>
            <?php
            }}else{
        ?> <?php
    }
    ?>

</div>
<!-- loading mui.min.js -->
<script type="text/javascript" src="/public/mobile/js/mui.min.js"></script>
<!-- loading mui.zoom.js -->
<script type="text/javascript" src="/public/mobile/js/mui.zoom.js"></script>
<!-- loading mui.previewimage -->
<script type="text/javascript" src="/public/mobile/js/mui.previewimage.js"></script>
<script type="text/javascript" src="/public/js/jquery-1.11.0.min.js"></script>
<script>
    mui.previewImage();
</script>
<div id="__MUI_PREVIEWIMAGE" class="mui-slider mui-preview-image mui-fullscreen">
    <div class="mui-preview-header">
        <span class="mui-preview-indicator"></span>
    </div>
    <div class="mui-slider-group"></div>
    <div class="mui-preview-footer mui-hidden"></div>
    <div class="mui-preview-loading">
        <span class="mui-spinner mui-spinner-white"></span>
    </div>
</div>
<script>
    function sound(text){
        $.get("/tip.php?text="+text, function(data){
//        var res = eval("(" + data + ")");//转为Object对象
            var res = data;//转为Object对象
            var audio = document.createElement("audio");
            audio.src = res;
            audio.play();
        });

    }
</script>
</body>
</html>