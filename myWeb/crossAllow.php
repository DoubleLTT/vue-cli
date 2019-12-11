<?php
/**
 * Created by PhpStorm.
 * User: yulin
 * Date: 2019/9/27
 * Time: 13:54
 */
//json头
header("Content-type: application/json");
//跨域
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin: *");
//CORS
header("Access-Control-Request-Methods:GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Headers:x-requested-with,content-type,test-token,test-sessid');//注意头部自定义参数不要用下划线