<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/12/28
 * Time: 9:48
 */

/**
图片压缩操作类
v1.0
 */
   class image{

       private $src;
       private $imageinfo;
       private $image;
       public  $percent = 0.1;
       public function __construct($src){

           $this->src = $src;

       }
       /**
       打开图片
        */
       public function openImage(){

           list($width, $height, $type, $attr) = getimagesize($this->src);
           $this->imageinfo = array(

               'width'=>$width,
               'height'=>$height,
               'type'=>image_type_to_extension($type,false),
               'attr'=>$attr
           );
           $fun = "imagecreatefrom".$this->imageinfo['type'];
           $this->image = $fun($this->src);
       }
       /**
       操作图片
        */
       public function thumpImage(){

           $new_width = $this->imageinfo['width'] * $this->percent;
           $new_height = $this->imageinfo['height'] * $this->percent;
           $image_thump = imagecreatetruecolor($new_width,$new_height);
           //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度
           imagecopyresampled($image_thump,$this->image,0,0,0,0,$new_width,$new_height,$this->imageinfo['width'],$this->imageinfo['height']);
           imagedestroy($this->image);
           $this->image =   $image_thump;
       }
       /**
       输出图片
        */
       public function showImage(){

//           header('Content-Type: image/'.$this->imageinfo['type']);
           $funcs = "image".$this->imageinfo['type'];
           $funcs($this->image);

       }
       /**
       保存图片到硬盘
        */
       public function saveImage($name){

           $funcs = "image".$this->imageinfo['type'];
           $funcs($this->image,$name.'.'.$this->imageinfo['type']);

       }
       function image_png_size_add($imgsrc,$imgdst){
           list($width,$height,$type)=getimagesize($imgsrc);
           $new_width = ($width)*0.7;
           $new_height =($height)*0.7;
//           $new_width = ($width>600?600:$width)*0.9;
//           $new_height =($height>600?600:$height)*0.9;
           switch($type){
               case 1:
                   $giftype=check_gifcartoon($imgsrc);
                   if($giftype){
//                       header('Content-Type:image/gif');
                       $image_wp=imagecreatetruecolor($new_width, $new_height);
                       $image = imagecreatefromgif($imgsrc);
                       imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                       imagejpeg($image_wp, $imgdst,75);
                       imagedestroy($image_wp);
                   }
                   break;
               case 2:
//                   header('Content-Type:image/jpg');
                   $image_wp=imagecreatetruecolor($new_width, $new_height);
                   $image = imagecreatefromjpeg($imgsrc);
                   imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                   imagejpeg($image_wp, $imgdst,75);
                   imagedestroy($image_wp);
                   break;
               case 3:
//                   header('Content-Type:image/png');
                   $image_wp=imagecreatetruecolor($new_width, $new_height);
                   $image = imagecreatefrompng($imgsrc);
                   imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                   imagejpeg($image_wp, $imgdst,75);
                   imagedestroy($image_wp);
                   break;
           }
       }
       /**
       销毁图片
        */
//       public function __destruct(){
//
//           imagedestroy($this->image);
//       }

   }