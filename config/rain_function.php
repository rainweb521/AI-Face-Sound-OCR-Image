<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/12/12
 * Time: 15:43
 */
require_once 'AipFace.php';
require_once 'AipOcr.php';
require_once 'AipImageClassify.php';
require_once 'AipNlp.php';
require_once 'AipSpeech.php';
require_once 'database.php';
class rain_function{
    // 人脸识别的 ID ，Key
    private $Face_APP_ID = '10498320';
    private $Face_API_KEY = '0N17xebL0uwNhAogL2S0lGFw';
    private $Face_SECRET_KEY = 'Qja3oVTvbYXEoN0ZB1U4qmgs7Ge51Zqp ';
    // 语音识别，合成的 ID，Key
    private $Sound_APP_ID = '10495881';
    private $Sound_API_KEY = '1F7P2iQ8USTNtA0wNxG0vtGv';
    private $Sound_SECRET_KEY = 'LzTHrMKGG3uUIf1rxXFzNL17vGDByN8V ';
    // 文字识别，合成的 ID，Key
    private $Ocr_APP_ID = '9855248';
    private $Ocr_API_KEY = '6gj5yyp1da7zAp4ylycMGA5t';
    private $Ocr_SECRET_KEY = 'rjBXwRG2pjc0uWacIoGaouwFf67m4iYC ';
    // 图像识别，合成的 ID，Key
    private $Image_APP_ID = '10523702';
    private $Image_API_KEY = 'F0z4px9AIsjHreaU4Z84rxsn';
    private $Image_SECRET_KEY = 'frQBdMwrWjsR3jgnqXGC4bPOMfNLErMy';
    // 自然语言处理，合成的 ID，Key
    private $Text_APP_ID = '10498297';
    private $Text_API_KEY = '9CGqp1FGGgVGvCirCv0EaEO0';
    private $Text_SECRET_KEY = 'GZ4k5obwgodxX1byiLsXdxXfllSWz2D8';
    /**
     * file_get_contens函数，用作所有图片的处理，应该是返回图片内容，还有URL的请求发起
     */
    function file_get_contents($filename, $incpath = false, $resource_context = null) {
        if (false === $fh = fopen($filename, 'rb', $incpath)) {
            user_error('file_get_contents() failed to open stream: No such file or directory',
                E_USER_WARNING);
            return false;
        }
        clearstatcache();
        if ($fsize = @filesize($filename)) {
            $data = fread($fh, $fsize);
        }
        else {
            $data = '';
            while (!feof($fh)) {
                $data .= fread($fh, 8192);
            }
        }
        fclose($fh);
        return $data;
    }
    /**
     *  人脸识别函数
     */
    function face($image_src,$image_src2=null,$type){
        $client = new AipFace($this->Face_APP_ID, $this->Face_API_KEY, $this->Face_SECRET_KEY);

        if ($type==1){
            // 调用人脸两两比对接口
            $result = $client->match(array(
                file_get_contents($image_src),
                file_get_contents($image_src2),
            ));
            $log = '人脸对比';
        }else{
            // 调用人脸检测
            $option = array(
                'max_face_num' => 20,
                'face_fields' => 'expression,beauty,faceshape,gender,glasses,age,race,qualities'

            );
            $result = $client->detect($this->file_get_contents($image_src),$option);
            $log = '人脸检测';
        }
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['image1'] = '.'.$image_src;
        $data['image2'] = '.'.$image_src2;
        $data['status'] = $log;
        $data['state'] = 1;
        $database = new database();
        $database->ai_InsertInfo($data);
        return $result;
    }
    /**
     *  文字识别函数
     */
    function ocr_recognition($image_src){
        $client = new AipOcr($this->Ocr_APP_ID, $this->Ocr_API_KEY, $this->Ocr_SECRET_KEY);
        // 调用通用文字识别接口
        $result = $client->basicGeneral($this->file_get_contents($image_src));
        $log = '通用文字识别';
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['image1'] = '.'.$image_src;
        $data['image2'] = '.';
        $data['status'] = $log;
        $data['state'] = 1;
        $database = new database();
        $database->ai_InsertInfo($data);
        return $result;
        // 如果图片是url 调用示例如下
//        $result = $client->basicGeneral('http://www.xxxxxx.com/img.jpg');
    }
    /**
     *  图像识别函数
     */
    function image_identification($image_src,$type){
        $client = new AipImageClassify($this->Image_APP_ID, $this->Image_API_KEY, $this->Image_SECRET_KEY);
        if ($type==2){
            // 图像识别函数--植物识别
            $result = $client->plantDetect($this->file_get_contents($image_src));
            $log = '植物识别';
        }elseif ($type==3){
            // 图像识别函数--车辆识别
            $result = $client->carDetect($this->file_get_contents($image_src));
            $log = '车辆识别';
        }elseif ($type==4){
            // 图像识别函数--Logo识别
            $result = $client->logoSearch($this->file_get_contents($image_src));
            $log = 'Logo识别';
        }else{
            // 图像识别函数--动物识别
            $result = $client->animalDetect($this->file_get_contents($image_src));
            $log = '动物识别';
        }
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['image1'] = '.'.$image_src;
        $data['image2'] = '.';
        $data['status'] = $log;
        $data['state'] = 1;
        $database = new database();
        $database->ai_InsertInfo($data);
        return $result;
        // 如果图片是url 调用示例如下
//        $result = $client->basicGeneral('http://www.xxxxxx.com/img.jpg');
    }

    function str_handling($text){
        $text = str_replace("\n", "", $text);
        $text = str_replace("\r", "", $text);
        $text = htmlspecialchars( $text);
        return $text;
    }
    /**
     *  自然语言处理
     */
    function language($text1, $text2,$type){
        $client = new AipNlp($this->Text_APP_ID, $this->Text_API_KEY, $this->Text_SECRET_KEY);
        if ($type==1){
            // 调用短文本相似度对比接口
            $result = $client->simnet($text1,$text2);
            $log = '短文本相似度对比';
        }else{
            // 调用情感倾向分析接口
            $result = $client->sentimentClassify($text1);
            $log = '情感倾向分析';
        }
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['image1'] = $text1;
        $data['image2'] = $text2;
        $data['status'] = $log;
        $data['state'] = 2;
        $database = new database();
        $database->ai_InsertInfo($data);
        return $result;
    }
    /**
     *  语音合成与识别处理
     */
    function sound($text,$per,$spd,$pit){
        $client = new AipSpeech($this->Sound_APP_ID, $this->Sound_API_KEY, $this->Sound_SECRET_KEY);
        // 调用语音合成接口
        $result = $client->synthesis($text, 'zh', 1, array(
            'vol' => 5,'per' => $per,'spd' => $spd,'pit' => $pit,
        ));

        // 识别正确返回语音二进制 错误则返回json 参照下面错误码
        //采用时间戳命名
        $fname = rand() . time();
        $file = './public/sound/'.$fname.'.mp3';
        if(!is_array($result)){
            file_put_contents($file, $result);
        }
        $log = '语音合成';

        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['image1'] = $text;
        $data['image2'] = '.'.$file;
        $data['status'] = $log;
        $data['state'] = 3;
        $database = new database();
        $database->ai_InsertInfo($data);
        return $file;
        // 如果图片是url 调用示例如下
//        $result = $client->basicGeneral('http://www.xxxxxx.com/img.jpg');
    }
    /**
     *  图片上传函数
     */
    function upload_file($file)
    {
        //全局变量
        $arrType = array('image/jpg', 'image/png', 'image/jpeg');
        $max_size = '500000';      // 最大文件限制（单位：byte）
        $upfile = './public/uploads'; //图片目录路径
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //判断提交方式是否为POST
            if (!is_uploaded_file($file['tmp_name'])) { //判断上传文件是否存在
//            return '文件不存在！';
                return '';
            }
//        if ($file['size'] > $max_size) {  //判断文件大小是否大于500000字节
//            return '上传文件太大！';
//        }
            if (!in_array($file['type'], $arrType)) {  //判断图片文件的格式
//            return '上传文件格式不对！';
                return '';
            }
            if (!file_exists($upfile)) {  // 判断存放文件目录是否存在
                mkdir($upfile, 0777, true);
            }
            $imageSize = getimagesize($file['tmp_name']);
            $img = $imageSize[0] . '*' . $imageSize[1];
            //采用时间戳命名
            $fname = rand() . time();
            $ftype = explode('.', $fname);
            $fileinfo = pathinfo($file['name']);
//                var_dump($fileinfo['extension']);
//                exit();
            $picName = $upfile . "/rain" . $fname . '.' . $fileinfo['extension'];
            if (file_exists($picName)) {
//            return '同文件名已存在！';
                return '';
            }
            if (!move_uploaded_file($file['tmp_name'], $picName)) {
//            return '移动文件出错！';
                return '';
            } else {
//                echo $picName."<br>";
//                echo "<font color='#FF0000'>图片文件上传成功！</font><br/>";
//                echo "<font color='#0000FF'>图片大小：$img</font><br/>";
//                echo "图片预览：<br><div style='border:#F00 1px solid; width:200px;height:200px'>
//                    <img src=\"".$picName."\" width=200px height=200px>".$fname."</div>";
                return $picName;

            }
        }
    }
}

?>