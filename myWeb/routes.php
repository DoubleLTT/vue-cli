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
    $item -> des = $row['des'];
    $item -> name = $row['name'];
    $item -> visit_time = $row['visit_time'];
    $item -> open_time = $row['open_time'];
    $item -> ticket = $row['ticket'];
    return $item;
}
$action=$_POST['action'];

if ($action=='getRoutes'){
    //查询所有地点
    $n=$_POST['n']; //n=1：加载热度最高的前4条地点  n=2：加载第4~8条
    $start=($n-1)*4;
    $sql = "select * from cd_routes LIMIT $start,4";
    $total_sql = "select * from cd_routes";
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
        $arr=explode(',',$row['place_id']);
        foreach($arr as $value)
        {
            $place_sql="select * from cd_places WHERE id='$value' ";
            $place_result = mysqli_query($conn,$place_sql);
            $place=new Place();
            $place_row=mysqli_fetch_assoc($place_result);
            array_push($res['places'],getPicsDetail($place,$place_row));
            //print_r($place_sql);
        }
        $res['total']=1;
        array_push($res['routes'],getRouteDetail($route,$row));
    }
}else{
    $res['msg']='something error';
}
echo json_encode($res);


