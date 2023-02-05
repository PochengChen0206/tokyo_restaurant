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
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $r1){
  $password_hash = $r1['password'];
  $email = $r1['email'];
  $nickname = $r1['nickname'];
  $userID = $r1['userID'];
  $user_level = $r1['user_level'];
}

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
  session_start();
  $_SESSION['userID'] = $userID;
  $_SESSION['name'] = $nickname;
  $_SESSION['level'] = $user_level;
  echo "<script>alert('登入成功');window.location.href='../index.php'</script>";
}else{
  echo "<script>alert('請檢查輸入的email或密碼是否正確');window.history.back(-1);</script>";
  exit();
}

exit();
?>

