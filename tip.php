<?php
require_once 'config/AipFace.php';
require_once 'config/AipSpeech.php';
require_once 'config/rain_function.php';
require_once 'config/database.php';
$function = new rain_function();
$database = new database();

// 语音识别，合成的 ID，Key
 $Sound_APP_ID = '10495881';
 $Sound_API_KEY = '1F7P2iQ8USTNtA0wNxG0vtGv';
 $Sound_SECRET_KEY = 'LzTHrMKGG3uUIf1rxXFzNL17vGDByN8V';

//$client = new AipFace(APP_ID, API_KEY, SECRET_KEY);
//$option = array(
//    'max_face_num' => 20,
//    'face_fields' => 'expression,beauty,faceshape,gender,glasses,race,qualities'
//
//);
//$result = $client->detect($function->file_get_contents('public/face3.jpg'),$option);
//var_dump($result);
//echo $result['result'][0]['beauty'];
//$url='http://www.jb51.net/';
//$html = $function->sound();
//var_dump($html);
//$database->reduce_UseNum('face1');
if(!empty($_GET['text'])){
$text = $_GET['text'];
$client = new AipSpeech('10495881', '1F7P2iQ8USTNtA0wNxG0vtGv', 'LzTHrMKGG3uUIf1rxXFzNL17vGDByN8V');
// 调用语音合成接口
$result = $client->synthesis($text, 'zh', 1, array(
    'vol' => 5,'spd' => 3,
));

// 识别正确返回语音二进制 错误则返回json 参照下面错误码
//采用时间戳命名
$fname = rand() . time();
$file = './public/sound/'.$fname.'.mp3';
if(!is_array($result)){
    file_put_contents($file, $result);
}
  echo $file;
}else{
    echo "null";
}
//echo $html;
?>