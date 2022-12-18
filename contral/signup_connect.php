<?php
require_once('../DBPDO.php');

//使用者名字
if($_POST['signup_user_name']==""){
  echo "<script>alert('請輸入使用者名稱');window.history.back(-1);</script>";
  exit();
}else{
  //判斷使用者名字是否註冊過
  $sql ="SELECT `user_name` FROM `user_info` WHERE `user_name` = :user_name";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':user_name',$_POST['signup_user_name'],PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if(isset($row['user_name'])){
    echo "<script>alert('輸入的名字已經註冊過');window.history.back(-1);</script>";
    exit();
  }else{
    $user_name = $_POST['signup_user_name'];
  }
}

//驗證是否為有效的email
if($_POST['signup_email']==""){
  echo "<script>alert('請輸入email');window.history.back(-1);</script>";
  exit();
}elseif(!filter_var($_POST['signup_email'], FILTER_VALIDATE_EMAIL)) {
  echo "<script>alert('請輸入正確的email格式');window.history.back(-1);</script>";
  exit();
}else{
  //判斷email是否有註冊過
  $sql ="SELECT `email` FROM `user_info` WHERE `email` = :email";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':email',$_POST['signup_email'],PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if(isset($row['email'])){
    echo "<script>alert('輸入的email已經註冊過');window.history.back(-1);</script>";
    exit();
  }else{
    $email = $_POST['signup_email'];
  }
}

//密碼
if($_POST['signup_password']==""){
  echo "<script>alert('請輸入密碼');window.history.back(-1);</script>";
  exit();
}else{
  $password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);
}

$sql = "INSERT INTO `user_info`(`user_name`,`email`,`password`,`created_date`)VALUES(:user_name,:email,:password,NOW())";
$stmt = $dbpdo->prepare($sql);
$stmt->bindParam(':user_name',$user_name,PDO::PARAM_STR);
$stmt->bindParam(':email',$email,PDO::PARAM_STR);
$stmt->bindParam(':password',$password,PDO::PARAM_STR);
$stmt->execute();

echo "<script>alert('註冊成功');window.location.href='../index.php'</script>";

exit();
?>

