<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>短文本相似度</title>
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
    <h1 align="center" style="margin-top: 3%;margin-bottom: -5%;font-size: 30px;">自然语言处理---短文本相似度功能</h1>
    <div align="center" style="margin-top: 5%;">
        <form enctype="multipart/form-data" method="post" action="face_detect.php" id="myform">
            <div class="am-form-group am-form-file">


                <!--    <input type="text" value="0" name="tip">-->
            </div>
            <!--        <button type="submit" class="am-btn am-btn-sm">提交</button>-->
        </form>
    </div>


        <?php
        $text1 = '';$text2='';
        if(!empty($_POST['text1'])){
            $text1 = $_POST['text1'];
            $text2 = $_POST['text2'];
//    echo "321342314123";
//    $data['g_addtime'] = date("Y-m-d");
//        onchange="document.getElementById('myform').submit();"                                    echo date("Y-m-d");
            require_once 'config/rain_function.php';
            $function = new rain_function();
            $text1 = $function->str_handling($text1);
            $text2 = $function->str_handling($text2);
            $result = $function->language($text1,$text2,1);
//    var_dump($result);
            ?>
            <div align="center" style="width: 50%;margin: auto;">
                <table class="am-table am-table-bordered am-table-centered">
                    <thead>
                    <tr class="am-danger">
                        <th width="23%">相似指数</th>
                        <th><?php echo $result['score'];?></th>
                    </tr>
                    </thead>
                </table>
            </div>
            <?php
        }else{
            ?> <?php
        }
        ?>


            <form class="am-form" method="post" action="text_similarity.php" id="myform"><fieldset>
            <div style="width: 100%;margin-bottom: 25%;">
            <div align="center" style="width: 45%;float: left;margin-left: 2%;margin-right: 1%;">
                <textarea class="" name="text1" rows="18" id="doc-ta-1"><?php echo $text1;?></textarea>
            </div>
            <div align="center" style="width: 45%;float: right;margin-right: 2%;margin-left: 1%;">
                <textarea class="" name="text2" rows="18" id="doc-ta-2"><?php echo $text2;?></textarea>
            </div>

           </div>

                    <div style="width: 40%;margin: auto;">
                        <p><button type="submit" class="am-btn am-btn-secondary am-btn-block">提交</button></p>
                    </div>
        </fieldset></form>

</main>
<script src="public/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="public/js/modernizr-custom.js"></script>
<script src="public/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>