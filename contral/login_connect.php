<?php
require_once('../DBPDO.php');
  
//驗證email
if($_POST['login_email'] == ""){
  echo "<script>alert('請輸入email');window.history.back(-1);</script>";
  exit();
}

$sql = "SELECT * FROM `user_info` WHERE `email` = :email";
$stmt = $dbpdo->prepare($sql);
$stmt->bindParam(':email', $_POST['login_email'], PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$password_hash = $result['password'];
$email = $result['email'];
$nickname = $result['nickname'];
$userID = $result['userID'];
$user_level = $result['user_level'];

if(!isset($email)){
  echo "<script>alert('請檢查輸入的email或密碼是否正確');window.history.back(-1);</script>";
  exit();
}

//驗證密碼
if($_POST['login_password'] == ""){
  echo "<script>alert('請輸入密碼');window.history.back(-1);</script>";
  exit();
}

$password = $_POST['login_password'];

if (password_verify($password, $password_hash)) {
  $_SESSION['userID'] = $userID;
  $_SESSION['name'] = $nickname;
  $_SESSION['level'] = $user_level;
  header("Location:../index.php");
}else{
  echo "<script>alert('請檢查輸入的email或密碼是否正確');window.history.back(-1);</script>";
  exit();
}

exit();
?>

