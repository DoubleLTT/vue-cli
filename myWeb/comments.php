<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/9/19
 * Time: 10:08
 */
include ("connect.php");
class Comment{
    public $id;
    public $name;
    public $time;
    public $title;
}
function getComments($item,$row){
    $item -> id = $row['id'];
    $item -> name = $row['name'];
    $item -> time = $row['time'];
    $item -> title = $row['title'];
    return $item;
}
$action=$_POST['action'];
$belongId=$_POST['id'];
if($action=="submitComment"){
    $name=$_POST['name'];
    $qs=$_POST['comment'];
    $time= date("Y-m-d");
    $sql="insert into cd_comments (belongId,name,time,title) VALUES ('$belongId','$name','$time','$qs')";
    $result=mysqli_query($conn,$sql);
    $res=['valid'=>false,'msg'=>''];
    if($result){
             $res['valid']=true;
             $res['msg']='回复成功！';
          }else{
                $res['msg']='回复失败,请稍后重试！';
          }
  }else{
    $sql = "select * from cd_comments WHERE belongId = '$belongId'";
    $result = mysqli_query($conn,$sql);
    $res=['valid'=>false,'msg'=>'','total'=>0,'comments'=>array()];
    if(mysqli_num_rows($result) > 0){
        $res['valid']=true;
        while($row = mysqli_fetch_assoc($result)){
              $comments=new Comment();
              array_push($res['comments'],getComments($comments,$row));
        }
    }else{
         $res['msg']='something error';
     }
}
echo json_encode($res);