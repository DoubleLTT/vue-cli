<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/9/3
 * Time: 11:09
 */

include ("connect.php");

$name=$_POST['name'];
$password=$_POST['password'];
$action=$_POST['action'];
$res=['valid'=>false,'msg'=>''];
if($action=='login'){
    $sql="select name,password from cd_users WHERE name='$name' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0 && $row['password']==$password){
        $res['valid']=true;
        $res['msg']='登录成功！';
    }else{
        $res['msg']='用户名或密码错误！';
    }
}else{
    $sql="UPDATE cd_users SET password=$password WHERE name='$name'";
    $result = mysqli_query($conn,$sql);
    if($result){
        $res['valid']=true;
        $res['msg']='修改成功！';
    }else{
        $res['msg']='修改失败，请稍后重试！';
    }
}

echo json_encode($res);