<?php
session_start();
require_once('../DBPDO.php');
$user_name = $_POST['setting_user_name'];
$nickname = $_POST['setting_nickname'];
$email = $_POST['setting_email'];
$opload_image = $_FILES['opload_image'];
$user_image = $_POST['user_image'];

if($opload_image['size']>0){
  if($opload_image['size']>1000000){
    echo alert_topre('上傳照片容量太大');
    exit();
  }else{
    $uploaded_path = "../images/user_image/".$opload_image['name'];
    move_uploaded_file($opload_image['tmp_name'],$uploaded_path);
  }
}else{
  //沒有上傳圖片則存入原本的圖片
  $uploaded_path = $user_image;
}


$sql = "UPDATE `user_info` SET `user_name` = :user_name, `nickname` = :nickname, `email` = :email, `user_image` = :user_image, `created_date` = NOW() WHERE `userID` = '".$_SESSION['userID']."'";
$stmt = $dbpdo->prepare($sql);
$stmt->bindParam(':user_name',$user_name,PDO::PARAM_STR);
$stmt->bindParam(':nickname',$nickname,PDO::PARAM_STR);
$stmt->bindParam(':email',$email,PDO::PARAM_STR);
$stmt->bindParam(':user_image',$uploaded_path,PDO::PARAM_STR);
$stmt->execute();

echo "<script>alert('個人資料已更新');window.location.href='../view/mypage.php?cate=userinfo'</script>";
exit();

?>