<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>自然语言处理</title>
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
?>
<main class="cd-main-content">
    <h1 align="center" style="margin-top: 3%;margin-bottom: -2%;font-size: 30px;">自然语言处理---
        <?php
        if (!empty($_GET['type'])){
            $type = $_GET['type'];
        }else{
            $type = 1;
        }
        if ($type==2){echo "词法分析";}else if ($type==6){echo "评论观点抽取";}else if ($type==7){echo "中文DNN语言模型";} else{echo "情感倾向分析";}
        ?>功能
        <br><span style="font-size: 17px;">
            <?php
            if ($type==2){echo "提供分词、词性标注、命名实体识别三大功能，支撑自然语言的准确理解";}
            else if ($type==6){echo "自动分析用户评论，输出评论观点与情感极性 ";}
            else if ($type==7){echo "输入中文句子，即可获得句子的通顺程度 ";}
            else{echo "对含主观信息的文本进行情感极性判断，为口碑分析、话题监控、舆情分析等应用提供基础技术支持";}
            if($type>7||$type<2){$type = 1;}
            $use_num = $function->use_num('6'.$type);
            ?>
        </span><br>
        <span style="font-size: 20px;" id="use_num">（今日剩余使用次数<?php echo $use_num;?>）</span>
    </h1>
    <?php if ($use_num==0){?>
        <h1 align="center" style="margin-top: 8%;font-size: 35px;">今日次数以及使用完毕，请明日再来</h1>
    <?php }else{?>
    <div align="center" style="margin-top: 3%;">
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
                <form class="am-form" method="post" action="text_affections.php?type=<?php echo $type;?>" id="myform">
                    <fieldset>
<!--                <label for="doc-ta-1">文本域</label>-->
                <textarea class="" name="text" rows="12"  id="doc-ta-1" placeholder="<?php if ($type==2){echo "例如：内蒙古师范大学是一所综合性大学";}else if ($type==6){echo "例如：三星手机的电池真不耐用";}else if ($type==7){echo "例如：床前明月光";} else{echo "例如：我很喜欢这个玩具";} ?>"></textarea>
                        <br>
                        <p><button type="submit" class="am-btn am-btn-secondary am-btn-block">提交</button></p>
                    </fieldset></form>
            </div>
        </div><?php }?>
    <?php

    if(!empty($_POST['text'])){
    $text = ($_POST['text']);
    //        echo $text;
    //    echo "321342314123";
    //    $data['g_addtime'] = date("Y-m-d");
    //        onchange="document.getElementById('myform').submit();"                                    echo date("Y-m-d");
    $text = $function->str_handling($text);
    $result = $function->language($text, '', $type);
        $use_num = $function->use_num('6'.$type);
//    var_dump($result);
        ?>
        <script>document.getElementById('use_num').innerHTML = '（今日剩余使用次数<?php echo $use_num;?>）';
        document.getElementById('doc-ta-1').value = '<?php echo $text;?>';</script>
        <div align="center" style="width: 40%;height:1000px; float: left;margin-bottom: 10%;">
            <?php
            if ($type == 2) {
                ?>
                <table class="am-table am-table-bordered am-table-centered">
                    <thead>
                    <tr>
                        <th>词汇</th>
                        <th>命名实体类型</th>
                        <th>词性</th>
                        <th>词汇的标准化表达</th>
                        <th>基本词成分</th>
                        <th>地址成分</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($result['items'] as $line){

                    ?>
                    <tr>
                        <td><?php echo($line['item']); ?></td>
                        <td><?php echo($line['ne']); ?></td>
                        <td><?php echo($line['pos']); ?></td>
                        <td><?php echo($line['formal']); ?></td>
                        <td><?php foreach ($line['basic_words'] as $line2) {
                                echo($line2 . ',');
                            }; ?></td>
                        <td><?php foreach ($line['loc_details'] as $line2) {
                                echo($line2 . ',');
                            }; ?></td>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                词性缩略说明
                <table class="am-table am-table-bordered am-table-centered">
                    <thead>
                    <tr>
                        <th>词性</th>
                        <th>含义</th>
                        <th>词性</th>
                        <th>含义</th>
                        <th>词性</th>
                        <th>含义</th>
                        <th>词性</th>
                        <th>含义</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>n</td>
                        <td>普通名词</td>
                        <td>nr</td>
                        <td>人名</td>
                        <td>nz</td>
                        <td>其他专名</td>
                        <td>a</td>
                        <td>形容词</td>
                    </tr>
                    <tr>
                        <td>m</td>
                        <td>数量词</td>
                        <td>c</td>
                        <td>连词</td>
                        <td>f</td>
                        <td>方位名词</td>
                        <td>ns</td>
                        <td>地名</td>
                    </tr>
                    <tr>
                        <td>v</td>
                        <td>普通动词</td>
                        <td>ad</td>
                        <td>副形词</td>
                        <td>q</td>
                        <td>量词</td>
                        <td>u</td>
                        <td>助词</td>
                    </tr>
                    <tr>
                        <td>s</td>
                        <td>处所名词</td>
                        <td>nt</td>
                        <td>机构团体名</td>
                        <td>vd</td>
                        <td>动副词</td>
                        <td>an</td>
                        <td>名形词</td>
                    </tr>
                    <tr>
                        <td>r</td>
                        <td>代词</td>
                        <td>xc</td>
                        <td>其他虚词</td>
                        <td>t</td>
                        <td>时间名词</td>
                        <td>nw</td>
                        <td>作品名</td>
                    </tr>
                    <tr>
                        <td>vn</td>
                        <td>名动词</td>
                        <td>d</td>
                        <td>副词</td>
                        <td>p</td>
                        <td>介词</td>
                        <td>w</td>
                        <td>标点符号</td>
                    </tr>
                    </tbody>
                    <table class="am-table am-table-bordered am-table-centered">
                        <thead>
                        <tr>
                            <th>缩略词</th>
                            <th>含义</th>
                            <th>缩略词</th>
                            <th>含义</th>
                            <th>缩略词</th>
                            <th>含义</th>
                            <th>缩略词</th>
                            <th>含义</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>PER</td>
                            <td>人名</td>
                            <td>LOC</td>
                            <td>地名</td>
                            <td>ORG</td>
                            <td>机构名</td>
                            <td>TIME</td>
                            <td>时间</td>
                        </tr>
                        </tbody>
                    </table>
                </table>
                <?php
            } else if ($type==6){
                if (!empty($result['error_code'])){
                echo "<h2>该评论无法抽取观点</h2>";

            }else{
            foreach ($result['items'] as $line) {

                ?>
                <table class="am-table am-table-bordered am-table-centered">
                    <tbody>
                    <tr>
                        <td>匹配上的属性词</td>
                        <td><?php echo($line['prop']); ?></td>
                    </tr>
                    <tr>
                        <td>匹配上的描述词</td>
                        <td><?php echo($line['adj']); ?></td>
                    </tr>
                    <tr>
                        <td>该情感搭配的极性</td>
                        <td><?php if ($line['sentiment'] == 1) {
                                echo "中性";
                            } elseif ($line['sentiment'] == 2) {
                                echo "积极";
                            } else {
                                echo "消极";
                            } ?></td>
                    </tr>
                    <tr>
                        <td>该情感搭配在句子中的开始位置</td>
                        <td><?php echo($line['begin_pos']); ?></td>
                    </tr>
                    <tr>
                        <td>该情感搭配在句子中的结束位置</td>
                        <td><?php echo($line['end_pos']); ?></td>
                    </tr>
                    <tr>
                        <td>对应于该情感搭配的短句摘要</td>
                        <td><?php echo($line['abstract']); ?></td>
                    </tr>
                    </tbody>
                </table>
                <?php
            } }  }else if($type==7) {
                ?>
                <table class="am-table am-table-bordered am-table-centered">
                    <thead><tr class="am-danger"><th width="23%">句子通顺值：</th><th><?php echo $result['ppl'];?>(数值越低句子越通顺)</th></tr></thead>
                </table>
                <table class="am-table am-table-bordered am-table-centered">
                    <thead><tr><th>句子的切词结果</th><th>该词在句子中的概率值</th></tr></thead>
                    <tbody>
                    <?php
                        foreach ($result['items'] as $line){
                    ?>
                            <tr><td><?php echo ($line['word']);?></td><td><?php echo ($line['prob']);?></td></tr>
                    <?php
                    }?>
                    </tbody>
                </table>
                <?php
            }else{
                            foreach ($result['items'] as $line){
                        ?>
                        <table class="am-table am-table-bordered am-table-centered">
                            <thead><tr><th>属性</th><th>值</th></tr></thead>
                            <tbody>
                            <tr>
                                <td>情感分类</td>
                                <td><?php if($line['sentiment']==1){echo "中性";}elseif ($line['sentiment']==2){echo "正向";}else{echo "负向";}?></td>
                            </tr>
                            <tr><td>情感分类置信度</td><td><?php echo ($line['confidence']);?></td></tr>
                            <tr><td>属于积极类别的概率</td><td><?php echo ($line['positive_prob']);?></td></tr>
                            <tr><td>属于消极类别的概率</td><td><?php echo ($line['negative_prob']);?></td></tr>
                            </tbody>
                        </table>
                        <?php
                    }
                     }?>

            </div>
        <?php
    }else{
        ?> <?php
    }
    ?>
        </div>
</main>
<script src="http://cos.rain1024.com/blog/static/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="http://cos.rain1024.com/blog/static/js/modernizr-custom.js"></script>
<script src="http://cos.rain1024.com/blog/static/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>

