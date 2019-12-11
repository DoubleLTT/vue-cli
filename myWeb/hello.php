<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>php test</title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    姓名：<input type="text" name="name"><br>
    电邮：<input type="text" name="email"><br>
    网址：<input type="text" name="website"><br>
    评论：<textarea name="comment" rows="5" cols="40"></textarea><br>
    性别：<input type="radio" name="gender" value="female">女
          <input type="radio" name="gender" value="male">男<br>
    <input type="submit" value="提交">
</form>
<?php
$name=$email=$gender=$comment=$website="";
if ($_SERVER["REQUEST_METHOD"]=='POST'){
    $name=input_valid($_POST['name']);
    $email=input_valid($_POST['email']);
    $gender=input_valid($_POST['gender']);
    $comment=input_valid($_POST['comment']);
    $website=input_valid($_POST['website']);
}
echo "你输入的信息是:".$name ."<br>" .$email ."<br>" .$gender ."<br>" .$comment ."<br>" .$website;
function input_valid($data){
    $data=trim($data); //去除多余空格
    $data=stripslashes($data); //去除反斜杠
    $data=htmlspecialchars($data); //防止攻击
    return $data;
}
?>
</body>
</html>