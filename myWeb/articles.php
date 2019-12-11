<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/9/19
 * Time: 10:08
 */
include ("connect.php");

class Article{
    public $id;
    public $title;
    public $content;
    public $url;
    public $time;
}
$action=$_POST['action'];
if($action=="getArticles"){
    $sql="SELECT * from articles LIMIT 3";
}
$result=mysqli_query($conn,$sql);
$res=['valid'=>false,'msg'=>'','articles'=>array()];
if(mysqli_num_rows($result)>0){
    $res['valid']=true;
    while($row=mysqli_fetch_assoc($result)){
        $article=new Article();
        $article->id=$row['id'];
        $article->title=$row['title'];
        $article->content=$row['content'];
        $article->url=$row['url'];
        $article->time=$row['time'];
        array_push($res['articles'],$article);
    }
}else{
    $res['msg']='noting find';
}
echo json_encode($res);