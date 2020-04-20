<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/8/30
 * Time: 14:06
 */


include ("connect.php");

class Food{
    public $id;
    public $name;
    public $url; //图片地址
    public $address;
    public $menu;
    public $phone;
    public $open;
}
class FoodDetail extends Food{
    public $e_name;
}
function getFoods($item,$row){
    $item -> id = $row['id'];
    $item -> name = $row['name'];
    $item -> url = $row['url'];
    $item -> address = $row['address'];
    $item -> menu = $row['menu'];
    $item -> phone = $row['phone'];
    $item -> open = $row['open'];
    return $item;
}
function getFoodDetail($item,$row){
    $item -> id = $row['id'];
    $item -> name = $row['name'];
    $item -> url = $row['url'];
    $item -> address = $row['address'];
    $item -> menu = $row['menu'];
    $item -> phone = $row['phone'];
    $item -> open = $row['open'];
    $item -> e_name = $row['e_name'];
    return $item;
}

$action=$_POST['action'];
$sql1="1=1";
$sql2="1=1";
$sql3="1=1";

if ($action=='getFoods'){
    //查询美食
    $n=$_POST['n']; //n=1：加载热度最高的前6条地点  n=2：加载第6~12条
    $start=($n-1)*6;
    if(!empty($_POST['menu']) && $_POST['menu'] !== "所有"){
            //按菜系查询
            $menus=$_POST['menu'];
            //$sql1 = "menu = '$menus'";
            $sql1 = "menu like '%{$menus}%'";
        }
        if(!empty($_POST['area']) && $_POST['area'] !== "所有"){
            //按区域查询
            $areas=$_POST['area'];
            $sql2 = "area = '$areas'";
        }
        if(!empty($_POST['name'])){
            //按名称查询
            $names=$_POST['name'];
            $sql3 = "name like '%{$names}%'";
            }
        $sql = "select * from cd_foods WHERE {$sql1} AND {$sql2} AND {$sql3} LIMIT $start,6";
        $total_sql = "select * from cd_foods WHERE {$sql1} AND {$sql2} AND {$sql3}";
}else{
        $id=$_POST['foodId'];   //获取餐厅详情
        $sql="select * from cd_foods WHERE id='$id' ";
    }

$result = mysqli_query($conn,$sql);

$res=['valid'=>false,'msg'=>'','total'=>0,'foods'=>array()];

if(mysqli_num_rows($result) > 0){
    $res['valid']=true;
    if ($action=='getFoods'){
        $total_result = mysqli_query($conn,$total_sql);
        if(mysqli_num_rows($total_result) > 0){
            while($row = mysqli_fetch_assoc($total_result)){
                $res['total']++;
            }
        }
        while($row = mysqli_fetch_assoc($result)){
            $food=new Food();
            array_push($res['foods'],getFoods($food,$row));
        }
    }else{
        $food=new FoodDetail();
        $row = mysqli_fetch_assoc($result);
        $res['total']=1;
        array_push($res['foods'],getFoodDetail($food,$row));
    }
}else{
    $res['msg']='something error';
}

echo json_encode($res);
