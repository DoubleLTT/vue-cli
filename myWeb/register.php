<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/9/2
 * Time: 15:05
 */

include ("connect.php");

$name=$_POST['name'];
$password=$_POST['password'];
$res=['valid'=>false,'msg'=>''];
$sql="insert into users (name,password) VALUES ('$name','$password')";
$result = mysqli_query($conn,$sql);
if($result){
    $res['valid']=true;
    $res['msg']='注册成功！';
}else{
    $res['msg']='注册失败！';
}
echo json_encode($res);