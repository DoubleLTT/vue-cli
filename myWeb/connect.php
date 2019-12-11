<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/9/2
 * Time: 15:03
 */
include("crossAllow.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_data";
// 创建连接
$conn = mysqli_connect($servername, $username, $password,$dbname);
mysqli_options($conn,MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);
// 检测连接
if (!$conn) {
    die("failed! 连接失败: " . mysqli_connect_error() );
}