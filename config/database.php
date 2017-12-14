<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/12/14
 * Time: 10:16
 */
class database{
    public function conn_mysql(){   //连接数据库函数
        $con = mysqli_connect("localhost","root","root","test");//数据库用户名和密码
        mysqli_query($con,"set names utf8;");

//        mysql_select_db("leave", $con); //要连接的数据库名
        return $con;
    }
    public function student_ListInfo($c_name){

        $c_id = $this->get_c_id($c_name);
        $con = $this->conn_mysql();  //连接mysql
        $result = mysqli_query($con,'SELECT * FROM student WHERE s_c_id="'.$c_id.'"');
        $this->close_mysql($con);   //释放连接
        return $result;
    }
    public function ListInfo(){
        $con = $this->conn_mysql();  //连接mysql
        $result = mysqli_query($con,'SELECT * FROM rain_ai ');
        $this->close_mysql($con);   //释放连接
        return $result;
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