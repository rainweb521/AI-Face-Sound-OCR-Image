<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>人脸检测</title>
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
    <h1 align="center" style="margin-top: 3%;margin-bottom: -2%;font-size: 30px;">人脸识别---人脸检测功能</h1>
    <div align="center" style="margin-top: 5%;">
        <form enctype="multipart/form-data" method="post" action="face_detect.php" id="myform">
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
        $result = $function->face($image_src,'',2);
//    var_dump($result);
        ?>
        <div style="width: 100%;">
            <div align="center" style="width: 50%;float: left;">
                <img src="<?php echo $image_src;?>" width="50%" height="50%">
            </div>
            <div align="center" style="width: 40%;height:1000px; float: left;margin-bottom: 10%;">
                <table class="am-table am-table-bordered am-table-centered">
                    <thead>
                    <tr>
                        <th width="23%">人脸数</th>
                        <th><?php echo $result['result_num'];?></th>
                    </tr>
                    </thead>
                </table>

                <?php
                foreach ($result['result'] as $line){

                    ?>
                    <table class="am-table am-table-bordered am-table-centered">
                        <thead>
                        <tr>
                            <th>人脸属性</th>
                            <th>值</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>颜值分数</td>
                            <td><?php echo $line['beauty'];?></td>
                        </tr>
                        <tr>
                            <td>面部表情</td>
                            <td><?php if($line['expression']==0){echo "不笑";}elseif($line['expression']==0){echo "微笑";}else{echo "大笑";}?></td>
                        </tr>
                        <tr>
                            <td>人物性别</td>
                            <td><?php if($line['gender']=='male'){echo "男";}else{echo "女";}?></td>
                        </tr>
                        <tr>
                            <td>眼镜类型</td>
                            <td><?php if($line['glasses']==0){echo "无眼镜";}elseif($line['glasses']==0){echo "普通眼镜";}else{echo "墨镜";}?></td>
                        </tr>
                        <tr>
                            <td>人种肤色</td>
                            <td><?php if($line['race']=='yellow'){echo "黄人";}elseif($line['race']=='white'){echo "白人";}
                                elseif($line['race']=='black'){echo "黑人";}else{echo "阿拉伯人";}?></td>
                        </tr>
                        <tr>
                            <td>人物年龄</td>
                            <td><?php echo $line['age'];?></td>
                        </tr>
                        <tr>
                            <td  rowspan="5" class="am-text-middle">人物脸型</td>
                            <td>方形脸概率：<?php echo $line['faceshape'][0]['probability'];?></td>
                        </tr>
                        <tr>
                            <td>三角形脸概率：<?php echo $line['faceshape'][1]['probability'];?></td>
                        </tr>
                        <tr>
                            <td>椭圆脸概率：<?php echo $line['faceshape'][2]['probability'];?></td>
                        </tr>
                        <tr>
                            <td>心型脸概率：<?php echo $line['faceshape'][3]['probability'];?></td>
                        </tr>
                        <tr>
                            <td>圆形脸概率：<?php echo $line['faceshape'][4]['probability'];?></td>
                        </tr>
                        <tr>
                            <td  rowspan="2" class="am-text-middle">真人/卡通</td>
                            <td>真实人脸置信度：<?php echo $line['qualities']['type']['human'];?></td>
                        </tr>
                        <tr>
                            <td>卡通人脸置信度：<?php echo $line['qualities']['type']['cartoon'];?></td>
                        </tr>
                        </tbody>
                    </table>
                <?php }?>


            </div>
        </div>

        <?php
    }else{
        ?> <?php
    }
    ?>

</main>
<script src="public/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="public/js/modernizr-custom.js"></script>
<script src="public/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>