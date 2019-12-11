<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/8/30
 * Time: 14:06
 */


include ("connect.php");

class Place{
    public $id;
    public $star;
    public $address;
    public $name;
    public $area;
    public $url; //图片地址
}
class PlaceDetail extends Place{
    public $detail_des;
    public $article; //游记
    public $says;//评价数量
}
function getPics($item,$row){
    $item -> id = $row['id'];
    $item -> star = $row['class'];
    $item -> address = $row['address'];
    $item -> name = $row['name'];
    $item -> area = $row['area'];
    $item -> url = $row['img'];
    return $item;
}
function getPicsDetail($item,$row){
    $item -> id = $row['id'];
    $item -> title = $row['title'];
    $item -> url = $row['pic'];
    $item -> price = $row['price'];
    $item -> des = $row['des'];
    $item -> star = $row['star'];
    $item -> detail_des = $row['detail_des'];
    $item -> article = $row['content'];
    $item -> says = $row['saynum'];
    return $item;
}
$action=$_POST['action'];
$sql1="1=1";
$sql2="1=1";

if ($action=='getPics'){
    //查询所有地点
    $n=$_POST['n']; //n=1：加载热度最高的前6条地点  n=2：加载第6~12条
    $start=($n-1)*6;
    if(!empty($_POST['star']) && $_POST['star'] !== "所有"){
        //按星级查询
        $stars=$_POST['star'];
        $sql1 = "class = '$stars'";
    }
    if(!empty($_POST['area']) && $_POST['area'] !== "所有"){
        //按区域查询
        $areas=$_POST['area'];
        $sql2 = "area = '$areas'";
    }
    $sql = "select * from cd_places WHERE {$sql1} AND {$sql2} LIMIT $start,6";
    $total_sql = "select * from cd_places WHERE {$sql1} AND {$sql2}";
    //echo $sql;
}
//else{
//    $id=$_POST['placeId'];   //获取地点详情
//    $sql="select * from cd_places WHERE id='$id' ";
//}

$result = mysqli_query($conn,$sql);
$total_result = mysqli_query($conn,$total_sql);

$res=['valid'=>false,'msg'=>'','total'=>0,'pics'=>array()];
if(mysqli_num_rows($total_result) > 0){
    while($row = mysqli_fetch_assoc($total_result)){
        $res['total']++;
    }
}

if(mysqli_num_rows($result) > 0){
    $res['valid']=true;
    if ($action=='getPics'){
        while($row = mysqli_fetch_assoc($result)){
            $place=new Place();
            array_push($res['pics'],getPics($place,$row));
        }
    }else{
        $place=new PlaceDetail();
        $row = mysqli_fetch_assoc($result);
        array_push($res['pics'],getPicsDetail($place,$row));
    }
}else{
    $res['msg']='something error';
}
echo json_encode($res);


