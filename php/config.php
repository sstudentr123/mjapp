<?php
// 不緩存 http://php.net/manual/zh/function.header.php
header("Cache-Control: no-cache, must-revalidate"); // 緩存HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past


// Session 存活時間
ini_set('session.cookie_lifetime', 0);
ini_set("session.gc_maxlifetime", 14400);


//程式訊息
//set_time_limit(0);


//错误信息
ini_set('display_errors',true);
ini_set('error_reporting',E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);


// 台灣時區
date_default_timezone_set('Asia/Taipei');


// MySQL 資料庫
//const MYSQL_HOST="192.168.0.248";
//const MYSQL_USERNAME="MJAPP_GUAN";
//const MYSQL_PASSWORD="MJAPP_GUAN";
//const MYSQL_DBNAME="MJAPP_GUAN";

// const MYSQL_HOST="localhost";
// const MYSQL_USERNAME="mjapp_guan";
// const MYSQL_PASSWORD="root";
// const MYSQL_DBNAME="admin";

const MYSQL_HOST="localhost";
const MYSQL_USERNAME="MJAPP";
const MYSQL_PASSWORD="root";
const MYSQL_DBNAME="admin";



//PDO
try {
    $pdo = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DBNAME);
    $pdo->query('set names utf8');
}catch ( PDOException $e) {
    $return = array("result"=>false, "message"=>$e->getMessage());
    echo json_encode($return);
}








//路徑
//define("ROOT",dirname(__FILE__));
//set_include_path(".".PATH_SEPARATOR.ROOT."/php".PATH_SEPARATOR.get_include_path());


//fun
//require_once 'mysql.func.php';
