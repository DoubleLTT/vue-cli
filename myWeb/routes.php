<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/8/30
 * Time: 14:06
 */


include ("connect.php");

class Route{
    public $id;
    public $title;
    public $des;
    public $ps;
    public $day;
    public $url; //图片地址
}
class RouteDetail extends Route{
    public $place_id;
    public $distance;
    public $num;
}
class Place{
    public $id;
    public $url;
    public $des;
    public $name;
    public $visit_time;
    public $open_time;
    public $ticket;
}
function getRoute($item,$row){
    $item -> id = $row['id'];
    $item -> title = $row['title'];
    $item -> des = $row['des'];
    $item -> ps = $row['ps'];
    $item -> day = $row['day'];
    $item -> url = $row['img'];
    return $item;
}
function getRouteDetail($item,$row){
    $item -> id = $row['id'];
    $item -> place_id = $row['place_id'];
    $item -> title = $row['title'];
    $item -> des = $row['des'];
    $item -> ps = $row['ps'];
    $item -> day = $row['day'];
    $item -> url = $row['img'];
    $item -> distance = $row['distence'];
    $item -> num = $row['num'];
    return $item;
}
function getPicsDetail($item,$row){
    $item -> id = $row['id'];
    $item -> url = $row['img'];
    $item -> des = $row['des'];
    $item -> name = $row['name'];
    $item -> visit_time = $row['visit_time'];
    $item -> open_time = $row['open_time'];
    $item -> ticket = $row['ticket'];
    return $item;
}
$action=$_POST['action'];
$sql1="1=1";
$sql2="1=1";
$sql3="1=1";

if ($action=='getRoutes'){
    //查询所有地点
    $n=$_POST['n']; //n=1：加载热度最高的前4条地点  n=2：加载第4~8条
    $start=($n-1)*4;
    if(!empty($_POST['day']) && $_POST['day'] !== "不限"){
            //按天数查询
            $days=$_POST['day'];
            $sql1 = "day IN ($days)";
    }
    if(!empty($_POST['light']) && $_POST['light'] !== "不限"){
            //按标签查询
            $lights=$_POST['light'];
            $sql2 = "ps REGEXP '$lights'";
        }
    if(!empty($_POST['name']) && $_POST['name'] !== "不限"){
            //按包含景区id查询
            $names=$_POST['name'];
            $sql3 = "place_id REGEXP '$names'";
    }

    $sql = "select * from cd_routes WHERE {$sql1} AND {$sql2} AND {$sql3} LIMIT $start,4";
    $total_sql = "select * from cd_routes WHERE {$sql1} AND {$sql2} AND {$sql3}";
//    $sql = "select * from cd_routes LIMIT $start,4";
//    $total_sql = "select * from cd_routes";
}else{
       $id=$_POST['routeId'];   //获取路线详情
       $sql="select * from cd_routes WHERE id='$id' ";
   }

$result = mysqli_query($conn,$sql);

$res=['valid'=>false,'msg'=>'','total'=>0,'routes'=>array(),'places'=>array()];

if(mysqli_num_rows($result) > 0){
    $res['valid']=true;
    if ($action=='getRoutes'){
        $total_result = mysqli_query($conn,$total_sql);
        if(mysqli_num_rows($total_result) > 0){
            while($row = mysqli_fetch_assoc($total_result)){
                $res['total']++;
            }
        }
        while($row = mysqli_fetch_assoc($result)){
            $route=new Route();
            array_push($res['routes'],getRoute($route,$row));
        }
    }else{
        $route=new RouteDetail();
        $row = mysqli_fetch_assoc($result);
        $arr=explode('|',$row['place_id']); // 第1天的景点|第2天的景点|第3天的景点|...
        $i=0;
        foreach($arr as $value)
        {
            $arr1=explode(',',$value); //景点之间用,分隔
            array_push($res['places'],[]);
            foreach($arr1 as $value1){
                $place_sql="select * from cd_places WHERE id='$value1' ";
                $place_result = mysqli_query($conn,$place_sql);
                $place=new Place();
                $place_row=mysqli_fetch_assoc($place_result);
                array_push($res['places'][$i],getPicsDetail($place,$place_row));
            }
            $i++;
        }
        //print_r($res['places']);
        $res['total']=1;
        array_push($res['routes'],getRouteDetail($route,$row));
    }
}else{
    $res['msg']='something error';
}
echo json_encode($res);


