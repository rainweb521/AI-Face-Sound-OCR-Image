<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/12/14
 * Time: 10:16
 */
class database{
    private $face = 2000;  /** @var int 人脸识别处理都是 2000次 */
    private $sound = 2000;  /** @var int 语音合成是 2000次 */
    private $ocr = 400;    /** @var int 文本识别也是 400次 */
    private $image = 400;  /** @var int 图片识别统一是400 次 */
    private $text = 5000; /** @var int 文本识别同一都是5000次 */
    public function conn_mysql(){   //连接数据库函数
        $con = mysqli_connect("localhost","root","root","test");//数据库用户名和密码
        mysqli_query($con,"set names utf8;");

//        mysql_select_db("leave", $con); //要连接的数据库名
        return $con;
    }
    public function get_Info($id){
        $con = $this->conn_mysql();  //连接mysql
        $result = mysqli_query($con,'SELECT * FROM rain_ai WHERE id="'.$id.'"');
        $this->close_mysql($con);   //释放连接
        return mysqli_fetch_array($result);
    }
    public function get_AllPageNum($page_num){
        $con = $this->conn_mysql();  //连接mysql
        $result = mysqli_query($con,'SELECT * FROM rain_ai '); //进行查询操作
        $all_num = $result->num_rows;
        if ($all_num%$page_num==0){
            $all_page = $all_num/$page_num;
        }else{
            /**
             *  这时候分页就会出现两种情况，总数大于，或者小于时，余数都不为0
             */
            $all_page = (intval($all_num/$page_num)) ;
            if ($all_num>$all_page*$page_num){
                $all_page = $all_page +1;
            }
        }
        $this->close_mysql($con);   //释放连接
        return ($all_page);
    }
    /** 后台显示数据的获取
     * @return bool|mysqli_result
     */
    public function ListInfo($page_num, $page){
        $con = $this->conn_mysql();  //连接mysql
        $result = mysqli_query($con,'SELECT * FROM rain_ai '); //进行查询操作
        $all_num = $result->num_rows;
        if ($all_num%$page_num==0){
            $all_page = $all_num/$page_num;
        }else{
            /**
             *  这时候分页就会出现两种情况，总数大于，或者小于时，余数都不为0
             */
            $all_page = (intval($all_num/$page_num)) ;
            if ($all_num>$all_page*$page_num){
                $all_page = $all_page +1;
            }
        }
        if ($page>$all_page||$page==-1){$page = $all_page;}
        if ($page<1){$page = 1;}
        $now_page_num = $page*$page_num-$page_num;
        $result = mysqli_query($con,'SELECT * FROM rain_ai LIMIT '.$now_page_num.','.$page_num);
        $this->close_mysql($con);   //释放连接
        return ($result);
    }
    private function ip_database_select($ip){
        $con = $this->conn_mysql();  //连接mysql
        $result = mysqli_query($con,'SELECT address FROM rain_ai WHERE ip="'.$ip.'"'); //进行查询操作
        $row = mysqli_fetch_array($result);  //获取查询到的数组
        $this->close_mysql($con);   //释放连接
        if (empty($row['address'])){
            return $this->ip_select($ip);
        }else{
            return $row['address'];
        }
    }
    public function ai_InsertInfo($data){
        $data['add_time'] = date('Y-m-d:h:i:sa');
        $data['address'] = $this->ip_database_select($data['ip']);;
        $con = $this->conn_mysql();  //连接mysql
        $return = mysqli_query($con,"INSERT INTO rain_ai VALUES(null,'{$data['add_time']}','{$data['ip']}','{$data['address']}','{$data['status']}','{$data['image1']}','{$data['image2']}','{$data['state']}')");
//        $return = mysql_query("INSERT INTO student(s_id,s_card,s_username,s_phone,s_addtime,s_grade,s_class,s_lastleave,s_state,s_c_id,s_g_id) VALUES(null,'1','1','1','1','1','1','','1','1','1')",$con);
//        var_dump(mysql_error());die();
        $this->close_mysql($con);   //释放连接
    }
    public function delete($s_id){
        $data = $this->get_Info($s_id);
        if ($data['state']!=2){
            if (($data['image1']!='.')&&($data['state']==1)){
                unlink($data['image1']);
            }
            if ($data['image2']!='.'){
                unlink($data['image2']);
            }
        }
        $con = $this->conn_mysql();  //连接mysql
        $result = mysqli_query($con,'DELETE FROM rain_ai WHERE id="'.$s_id.'"');
        $this->close_mysql($con);   //释放连接
    }

    /**
     * 用于建立新的使用次数记录
     */
    public function create_UseNum(){
        $date = date('Y-m-d');
        $state = 1;
        $con = $this->conn_mysql();  //连接mysql
        $return = mysqli_query($con,"INSERT INTO ai_use VALUES(null,'{$state}','{$date}','{$this->face}','{$this->face}',
            '{$this->sound}','{$this->ocr}','{$this->image}','{$this->image}','{$this->image}','{$this->image}','{$this->text}'
            ,'{$this->text}','{$this->text}','{$this->text}','{$this->text}','{$this->text}','{$this->text}','{$this->text}')");
        $this->close_mysql($con);   //释放连接
    }
    /** 用于查询每个功能所剩余的次数
     * @param $field
     * @return array|int|null
     */
    public function get_UseNum($field){
        $date = date('Y-m-d');
        $con = $this->conn_mysql();  //连接mysql
        $result = mysqli_query($con,'SELECT '.$field.' FROM ai_use WHERE date="'.$date.'"');
        $row = mysqli_fetch_array($result);
        if (empty($row[0])){
            $this->create_UseNum();
            $result = mysqli_query($con,'SELECT '.$field.' FROM ai_use WHERE date="'.$date.'"');
            $row = mysqli_fetch_array($result);
        }
        $this->close_mysql($con);   //释放连接
        return $row[0];
    }
    public function reduce_UseNum($field){
        $date = date('Y-m-d');
        $con = $this->conn_mysql();  //连接mysql
        $result = mysqli_query($con,'SELECT '.$field.' FROM ai_use WHERE date="'.$date.'"');
        $row = mysqli_fetch_array($result);
        $row = $row[0] - 1;
//        var_dump($row);
        $result = mysqli_query($con,'update ai_use set '.$field.'="'.$row.'" where date="'.$date.'"');
        $this->close_mysql($con);   //释放连接
//        var_dump($result);
    }
    public function close_mysql($con){  //释放连接的函数
        mysqli_close($con);
    }
    /** IP地址查询接口函数
     * @param $ip IP地址
     */
    private function ip_select($ip){
//        $ip = '27.189.201.108';
        $datatype = 'txt';
        $url = 'http://api.ip138.com/query/?ip='.$ip.'&datatype='.$datatype;
        $header = array('token:d5dd821801f23acef2a763e49d3c492f');
//        echo getData($url,$header);
//        function getData($url,$header){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);
        $handles = curl_exec($ch);
        curl_close($ch);
        return $handles;
    }
}