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

</head>
<body>

<main class="cd-main-content">
    <h1 align="center" style="margin-top: -1%;margin-bottom: 2%;font-size: 30px;">后台访问记录</h1>
    <div style="width:80%;margin: auto;">
    <table class="am-table am-table-bordered am-table-radius am-table-striped">
        <thead>
        <tr>
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
        require ('../config/database.php');
        $databse = new database();
        $list = $databse->ListInfo();
        while($line = mysqli_fetch_array($list)){
        //var_dump($line[0]);echo "<br>";
        ?>
        <tr>
            <td><?php echo $line['address'];?></td>
            <td><?php echo $line['add_time'];?></td>
            <td><?php echo $line['status'];?></td>
            <?php if ($line['state']==1){?>
                <td><img src="<?php echo $line['image1'];?>" width="40%" height="20%"></td>
                <td><img src="<?php echo $line['image2'];?>" width="40%" height="20%"></td>
            <?php }else{?>

                <td><textarea rows="3" cols="30"><?php echo $line['image1'];?></textarea></td>
                <td><textarea rows="3" cols="30"><?php echo $line['image2'];?></textarea></td>
            <?php }?>
            <td><button type="button" class="am-btn am-btn-danger am-btn-xs">删除</button></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    </div>
</main>
<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="js/modernizr-custom.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>

