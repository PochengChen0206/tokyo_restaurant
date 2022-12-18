<?php
require_once('../DBPDO.php');
  
//驗證email
if($_POST['login_email']==""){
  echo "<script>alert('請輸入email');window.history.back(-1);</script>";
  exit();
}

$sql ="SELECT `email`,`password` FROM `user_info` WHERE `email` = :email";
$stmt = $dbpdo->prepare($sql);
$stmt->bindParam(':email',$_POST['login_email'],PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!isset($row['email'])){
  echo "<script>alert('請檢查輸入的email或密碼是否正確');window.history.back(-1);</script>";
  exit();
}

//驗證密碼
if($_POST['login_password']==""){
  echo "<script>alert('請輸入密碼');window.history.back(-1);</script>";
  exit();
}

if (password_verify($_POST['login_password'], $row['password'])) {
  session_start();
  $_SESSION['EMAIL'] = $row['email'];
}else{
  echo "<script>alert('請檢查輸入的email或密碼是否正確');window.history.back(-1);</script>";
  exit();
}

echo "<script>alert('登入成功');window.location.href='../index.php'</script>";
exit();
?>

