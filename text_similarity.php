<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>短文本相似度</title>
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
<!--<div align="left" style="margin-top: 2%;margin-left: 2%;font-size: 30px;">-->
<!--    <button class="am-btn am-btn-default am-btn-xl" onclick="location.href='index.html';">返回</button>-->
<!--</div>-->
<?php require ('header.php');
require_once 'config/rain_function.php';
$function = new rain_function();
$use_num = $function->use_num('1');
?>
<main class="cd-main-content">
    <h1 align="center" style="margin-top: 3%;margin-bottom: -5%;font-size: 30px;">自然语言处理---
        <?php
        if (!empty($_GET['type'])){
            $type = $_GET['type'];
        }else{
            $type = 3;
        }
        if ($type==4){echo "词义相似度";} else{echo "短文本相似度";}
        ?>功能
        <br><span style="font-size: 17px;">
            <?php
            if ($type==4){echo "依托全网海量优质数据和深度神经网络技术，通过词语向量化来计算两个词之间的相似度";}
            else{echo "输入两段中文短文本，即可输出文本间的语义相似度。帮助快速实现推荐、检索、排序等应用";}
            if($type!=4){$type = 3;}
            $use_num = $function->use_num('6'.$type);
            ?>
        </span><br>
        <span style="font-size: 20px;" id="use_num">（今日剩余使用次数<?php echo $use_num;?>）</span>
    </h1>
    <?php if ($use_num==0){?>
        <h1 align="center" style="margin-top: 8%;font-size: 35px;">今日次数以及使用完毕，请明日再来</h1>
    <?php }else{?>
    <div align="center" style="margin-top: 5%;">
        <form enctype="multipart/form-data" method="post" action="face_detect.php" id="myform">
            <div class="am-form-group am-form-file">
                <!--    <input type="text" value="0" name="tip">-->
            </div>
            <!--        <button type="submit" class="am-btn am-btn-sm">提交</button>-->
        </form>
    </div><?php }?>
        <?php
        $text1 = '';$text2='';
        if(!empty($_POST['text1'])){
            $text1 = $_POST['text1'];
            $text2 = $_POST['text2'];
//    echo "321342314123";
//    $data['g_addtime'] = date("Y-m-d");
//        onchange="document.getElementById('myform').submit();"                                    echo date("Y-m-d");
            $text1 = $function->str_handling($text1);
            $text2 = $function->str_handling($text2);
            $result = $function->language($text1,$text2,$type);
            $use_num = $function->use_num('6'.$type);
//    var_dump($result);
            ?>
            <script>document.getElementById('use_num').innerHTML = '（今日剩余使用次数<?php echo $use_num;?>）';</script>
            <div align="center" style="width: 50%;margin: auto;">
                <table class="am-table am-table-bordered am-table-centered">
                    <thead><tr class="am-danger"><th width="23%">相似指数</th><th><?php echo $result['score'];?></th></tr></thead>
                </table>
            </div>
            <?php
        }else{
            ?> <?php
        }
        ?>
            <form class="am-form" method="post" action="text_similarity.php?type=<?php echo $type;?>" id="myform"><fieldset>

                <?php
                if ($type==4){
                    ?>
                    <div style="width: 100%;margin-bottom: 16%;margin-top: 5%;">
                    <div align="center" style="width: 35%;float: left;margin-left: 12%;margin-right: 1%;">
                        <textarea class="" name="text1" rows="1" id="doc-ta-1"><?php echo $text1;?></textarea>
                    </div>
                    <div align="center" style="width: 35%;float: right;margin-right: 12%;margin-left: 1%;">
                        <textarea class="" name="text2" rows="1" id="doc-ta-2"><?php echo $text2;?></textarea>
                    </div>
                    <?php
                } else{
                    ?><div style="width: 100%;margin-bottom: 25%;">
                    <div align="center" style="width: 35%;float: left;margin-left: 12%;margin-right: 1%;">
                        <textarea class="" name="text1" rows="12" id="doc-ta-1"><?php echo $text1;?></textarea>
                    </div>
                    <div align="center" style="width: 35%;float: right;margin-right: 12%;margin-left: 1%;">
                        <textarea class="" name="text2" rows="12" id="doc-ta-2"><?php echo $text2;?></textarea>
                    </div>
                    <?php
                }
                ?>

           </div>
                    <div style="width: 40%;margin: auto;margin-top: -8%;">
                        <p><button type="submit" class="am-btn am-btn-secondary am-btn-block">提交</button></p>
                    </div>
        </fieldset></form>


</main>
<script src="http://cos.rain1024.com/blog/static/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="http://cos.rain1024.com/blog/static/js/modernizr-custom.js"></script>
<script src="http://cos.rain1024.com/blog/static/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>