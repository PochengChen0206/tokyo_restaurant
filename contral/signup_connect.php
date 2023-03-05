<?php
require_once('../DBPDO.php');
require_once('../contral/function.php');
//使用者名字
if($_POST['signup_user_name'] == ""){
  echo alert_topre('請輸入使用者名稱');
  exit();
}else{
  $user_name = $_POST['signup_user_name'];
}

//使用者暱稱
if($_POST['signup_nickname'] == ""){
  echo alert_topre('請輸入使用者暱稱');
  exit();
}else{
  //判斷使用者暱稱是否註冊過
  $sql = "SELECT `nickname` FROM `user_info` WHERE `nickname` = :nickname";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':nickname',$_POST['signup_nickname'],PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if(count($result) > 0){
    echo alert_topre('輸入的暱稱已經註冊過');
    exit();
  }else{
    $nickname = $_POST['signup_nickname'];
  }
}

//驗證是否為有效的email
if($_POST['signup_email'] == ""){
  echo alert_topre('請輸入email'); 
  exit();
}elseif(!filter_var($_POST['signup_email'], FILTER_VALIDATE_EMAIL)) {
  echo alert_topre('請輸入正確的email格式');
  exit();
}else{
  //判斷email是否有註冊過
  $sql = "SELECT `email` FROM `user_info` WHERE `email` = :email";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':email',$_POST['signup_email'],PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if(count($result) > 0){
    echo alert_topre('輸入的email已經註冊過');
    exit();
  }else{
    $email = $_POST['signup_email'];
  }
}

//密碼
if($_POST['signup_password'] == ""){
  echo alert_topre('請輸入密碼');
  exit();
}else{
  $password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);
}

$sql = "INSERT INTO `user_info`(`user_name`, `nickname`, `email`, `password`, `created_date`)VALUES(:user_name, :nickname, :email, :password, NOW())";
$stmt = $dbpdo->prepare($sql);
$stmt->bindParam(':user_name',$user_name,PDO::PARAM_STR);
$stmt->bindParam(':nickname',$nickname,PDO::PARAM_STR);
$stmt->bindParam(':email',$email,PDO::PARAM_STR);
$stmt->bindParam(':password',$password,PDO::PARAM_STR);
$stmt->execute();
$last_userID = $dbpdo->lastInsertId();

$sql1 = "SELECT * FROM `user_info` WHERE `userID` = '".$last_userID."'";
$stmt1 = $dbpdo->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

$userID = $result1['userID'];
$nickname = $result1['nickname'];
$user_level = $result1['user_level'];

$_SESSION['userID'] = $userID;
$_SESSION['name'] = $nickname;
$_SESSION['level'] = $user_level;

header("Location:../index.php");
exit();
?>

