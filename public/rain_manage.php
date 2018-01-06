<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AI-人工智能</title>
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/amazeui.flat.min.css">
    <script src="assets/js/amazeui.ie8polyfill.min.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.widgets.helper.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/handlebars.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css">
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
<?php
if(empty($_GET['rain_key'])){
    echo "<script>location.href='../index.php';</script>";
}else{
    $rain_key = $_GET['rain_key'];
    $rain_key = htmlspecialchars($rain_key);
    if ($rain_key!='0zhBZwsuWM706HJQ6x3Y'){
        echo "<script>location.href='../index.php';</script>";
    }
    require ('../config/database.php');
    $databse = new database();
    $all_page_num = $databse->get_AllPageNum(5);
}
?>
<main class="cd-main-content">
    <a href="rain_manage.php?rain_key=<?php echo $rain_key;?>"><h1 align="center" style="margin-top: -1%;margin-bottom: 2%;font-size: 30px;">后台访问记录</h1></a>
    <div style="width:80%;margin: auto;">
        <span style="font-size: 18px;">共有<?php echo $all_page_num;?>页</span>
    <table class="am-table am-table-bordered am-table-radius am-table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>访问者地址</th>
            <th>时间</th>
            <th>类型</th>
            <th width="20%">内容1</th>
            <th width="20%">内容2</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if (!empty($_GET['type'])){
            $type = $_GET['type'];
            $id = $_GET['id'];
            $databse->delete($id);
        }
        if (empty($_GET['page'])){$page = 1;}
        else{$page = $_GET['page'];}
        if (!is_numeric($page)){$page = 1;}
        $list = $databse->ListInfo($page_num=5,$page);
        while($line = (mysqli_fetch_array($list))){
        //var_dump($line[0]);echo "<br>";
        ?>
        <tr><td><?php echo $line['id'];?></td>
            <td><?php echo $line['address'];?></td>
            <td><?php echo $line['add_time'];?></td>
            <td><?php echo $line['status'];?></td>
            <?php if ($line['state']==1){?>
                <td><img src="<?php echo $line['image1'];?>" width="100px" height="50px"></td>
                <td><img src="<?php echo $line['image2'];?>" width="100px" height="50px"></td>
            <?php }elseif($line['state']==3){?>
                <td><textarea rows="3" cols="30"><?php echo $line['image1'];?></textarea></td>
                <td>
                    <audio controls="controls">
                        <source src="<?php echo $line['image2'];?>" type="audio/mpeg">
                        您的浏览器不支持音频元素。
                    </audio>
                </td>
            <?php }else{?>
                <td><textarea rows="3" cols="30"><?php echo $line['image1'];?></textarea></td>
                <td><textarea rows="3" cols="30"><?php echo $line['image2'];?></textarea></td>
            <?php }?>
            <td><button type="button" onclick="location.href='rain_manage.php?rain_key=<?php echo $rain_key;?>&type=delete&id=<?php echo $line["id"];?>';" class="am-btn am-btn-danger am-btn-xs">删除</button></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
        <div class="am-cf" style="margin-right: auto;">

            <div class="am-fr">
                <ul class="am-pagination tpl-pagination">
                    <li class="am-active"><a href="rain_manage.php?rain_key=<?php echo $rain_key;?>&page=1">首页</a></li>
                    <li class="am-active"><a href="rain_manage.php?rain_key=<?php echo $rain_key;?>&page=<?php echo $page-1;?>">上一页</a></li>
                    <li class="am-active"><a href="rain_manage.php?rain_key=<?php echo $rain_key;?>&page=<?php echo $page+1;?>">下一页</a></li>
                    <li class="am-active"><a href="rain_manage.php?rain_key=<?php echo $rain_key;?>&page=<?php echo $all_page_num;?>">尾页</a></li>
                </ul>
            </div>
        </div>
    </div>
</main>
<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="js/modernizr-custom.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>

