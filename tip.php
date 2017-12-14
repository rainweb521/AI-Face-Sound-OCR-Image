<?php
require_once 'config/AipFace.php';
require_once 'config/rain_function.php';
$function = new rain_function();
// 你的 APPID AK SK
const APP_ID = '10498320';
const API_KEY = '0N17xebL0uwNhAogL2S0lGFw';
const SECRET_KEY = 'Qja3oVTvbYXEoN0ZB1U4qmgs7Ge51Zqp ';

$client = new AipFace(APP_ID, API_KEY, SECRET_KEY);
$option = array(
    'max_face_num' => 20,
    'face_fields' => 'expression,beauty,faceshape,gender,glasses,race,qualities'

);
//$result = $client->detect($function->file_get_contents('public/face3.jpg'),$option);
//var_dump($result);
//echo $result['result'][0]['beauty'];
$url='http://www.jb51.net/';
$html = $function->sound();
var_dump($html);
//echo $html;
?>