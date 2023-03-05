<?php
require_once('../DBPDO.php');
require_once('../contral/function.php');

//驗證是否為有效的email
if($_POST['restpwd_email'] == ""){
  echo alert_topre('請輸入email'); 
  exit();
}elseif(!filter_var($_POST['restpwd_email'], FILTER_VALIDATE_EMAIL)) {
  echo alert_topre('請輸入正確的email格式');
  exit();
}else{
  $check_email = $_POST['restpwd_email'];
  //判斷email是否有註冊過
  $sql = "SELECT `email`, `user_name` FROM `user_info` WHERE `email` = :email";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':email', $check_email, PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if($result['email'] != $check_email){
    echo alert_topre('此信箱尚未註冊');
    exit();
  }else{
    $user_name = $result['user_name'];
    //寄給使用者的暫時新密碼
    $password_new_sent = make_tmp_password(10);
    //存入DB的加密暫時密碼
    $password_new_save = password_hash($password_new_sent, PASSWORD_DEFAULT);
    
    $sql_update = "UPDATE `user_info` SET `password` = :password WHERE `email` = '".$check_email."'";
    $stmt = $dbpdo->prepare($sql_update);
    $stmt->bindParam(':password', $password_new_save, PDO::PARAM_STR);
    $stmt->execute();

    include('../contral/send_mail.php');
    echo alert_toindex('已寄發新密碼');
    exit();
  }
}
?>