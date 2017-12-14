<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>自然语言处理</title>
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
    <h1 align="center" style="margin-top: 3%;margin-bottom: -2%;font-size: 30px;">自然语言处理---情感分析功能</h1>
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
                <form class="am-form" method="post" action="text_affections.php" id="myform">
                    <fieldset>
<!--                <label for="doc-ta-1">文本域</label>-->
                <textarea class="" name="text" rows="12"  id="doc-ta-1"></textarea>
                        <br>
                        <p><button type="submit" class="am-btn am-btn-secondary am-btn-block">提交</button></p>
                    </fieldset></form>
            </div>
        </div>
    <?php

    if(!empty($_POST['text'])){
        $text = ($_POST['text']);
//        echo $text;
//    echo "321342314123";
//    $data['g_addtime'] = date("Y-m-d");
//        onchange="document.getElementById('myform').submit();"                                    echo date("Y-m-d");
        require_once 'config/rain_function.php';
        $function = new rain_function();
        $text = $function->str_handling($text);
        $result = $function->language($text,'',2);
//    var_dump($result);
        ?>
     <script>document.getElementById('doc-ta-1').value = '<?php echo $text;?>';</script>
            <div align="center" style="width: 40%;height:1000px; float: left;margin-bottom: 10%;">

                <?php
                foreach ($result['items'] as $line){

                    ?>
                    <table class="am-table am-table-bordered am-table-centered">
                        <thead>
                        <tr>
                            <th>属性</th>
                            <th>值</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>情感分类</td>
                            <td><?php if($line['sentiment']==1){echo "中性";}elseif ($line['sentiment']==2){echo "正向";}else{echo "负向";}?></td>
                        </tr>
                        <tr>
                            <td>情感分类置信度</td>
                            <td><?php echo ($line['confidence']);?></td>
                        </tr>
                        <tr>
                            <td>属于积极类别的概率</td>
                            <td><?php echo ($line['positive_prob']);?></td>
                        </tr>
                        <tr>
                            <td>属于消极类别的概率</td>
                            <td><?php echo ($line['negative_prob']);?></td>
                        </tr>
                        </tbody>
                    </table>
                <?php }?>


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

