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
$email=$_POST['mail'];
$res=['valid'=>false,'msg'=>''];
$sql1="select name from cd_users WHERE name='$name' ";
$result1 = mysqli_query($conn,$sql1);
if(mysqli_num_rows($result1) > 0){
    $res['msg']='注册失败，该用户名已存在！';
}else{
    $sql="insert into cd_users (name,password,email) VALUES ('$name','$password','$email')";
    $result = mysqli_query($conn,$sql);
    if($result){
        $res['valid']=true;
        $res['msg']='注册成功！';
    }else{
        $res['msg']='注册失败,请稍后重试！';
    }
}
echo json_encode($res);