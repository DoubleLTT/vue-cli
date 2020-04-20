<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/9/19
 * Time: 10:08
 */
include ("connect.php");
class Question{
    public $id;
    public $name;
    public $time;
    public $title;
}
function getQuestions($item,$row){
    $item -> id = $row['id'];
    $item -> name = $row['name'];
    $item -> time = $row['time'];
    $item -> title = $row['title'];
    return $item;
}
$action=$_POST['action'];
if($action=="submitQuestion"){
    $name=$_POST['name'];
    $qs=$_POST['question'];
    $time= date("Y-m-d");
    $sql="insert into cd_questions (name,time,title) VALUES ('$name','$time','$qs')";
    $result=mysqli_query($conn,$sql);
    $res=['valid'=>false,'msg'=>''];
    if($result){
            $res['valid']=true;
            $res['msg']='发布成功！';
        }else{
            $res['msg']='发布失败,请稍后重试！';
        }
}else if($action=="submitComment"){
    $name=$_POST['name'];
    $qs=$_POST['comment'];
    $belongId=$_POST['id'];
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
    $sql1="1=1";
    $sql2="1=1";
    $n=$_POST['n']; //n=1：加载热度最高的前6条地点  n=2：加载第6~12条
    $start=($n-1)*6;
    if(!empty($_POST['question'])){
        //查询
        $search=$_POST['question'];
        $sql1 = "title like '%{$search}%'";
    }
    if(!empty($_POST['name'])){
            //查询
            $username=$_POST['name'];
            $sql2 = "name = '$username'";
        }
    $sql = "select * from cd_questions WHERE {$sql1} AND {$sql2} LIMIT $start,6";
    $total_sql = "select * from cd_questions WHERE {$sql1} AND {$sql2}";
    $result = mysqli_query($conn,$sql);
    $res=['valid'=>false,'msg'=>'','total'=>0,'qs'=>array()];
    if(mysqli_num_rows($result) > 0){
        $res['valid']=true;
        $total_result = mysqli_query($conn,$total_sql);
                if(mysqli_num_rows($total_result) > 0){
                    while($row = mysqli_fetch_assoc($total_result)){
                        $res['total']++;
                    }
                }
                while($row = mysqli_fetch_assoc($result)){
                    $questions=new Question();
                    array_push($res['qs'],getQuestions($questions,$row));
                }
    }else{
         $res['msg']='something error';
     }
}
echo json_encode($res);