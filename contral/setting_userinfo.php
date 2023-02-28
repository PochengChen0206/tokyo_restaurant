<?php
require_once('../DBPDO.php');

//修改會員資料
if($_POST['formID'] == "seeting_userinfo"){
  $user_name = $_POST['setting_user_name'];
  $nickname = $_POST['setting_nickname'];
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


  $sql = "UPDATE `user_info` SET `user_name` = :user_name, `nickname` = :nickname, `user_image` = :user_image, `created_date` = NOW() WHERE `userID` = '".$_SESSION['userID']."'";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':user_name',$user_name,PDO::PARAM_STR);
  $stmt->bindParam(':nickname',$nickname,PDO::PARAM_STR);
  $stmt->bindParam(':user_image',$uploaded_path,PDO::PARAM_STR);
  $stmt->execute();

  echo "<script>alert('個人資料已更新');window.location.href='../view/mypage.php?cate=userinfo'</script>";
  exit();
}elseif($_POST['formID'] == "password_reset"){ //修改會員密碼
  $sql = "SELECT `password` FROM `user_info` WHERE `userID` = '".$_SESSION['userID']."'";
  $stmt = $dbpdo->prepare($sql);
  $stmt->execute();
  $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
  $password_now_check = $user_info['password'];
  
  if (!password_verify($_POST['password_now'], $password_now_check)) {
    echo "<script>alert('請重新確認舊密碼是否輸入正確');window.history.back(-1);</script>";
    exit();
  }else{
    $sql = "UPDATE `user_info` SET `password` = :password WHERE `userID` = '".$_SESSION['userID']."'";
    $password_new = password_hash($_POST['password_new'], PASSWORD_DEFAULT);
    $stmt = $dbpdo->prepare($sql);
    $stmt->bindParam(':password',$password_new,PDO::PARAM_STR);
    $stmt->execute();
    session_destroy();
    echo "<script>alert('密碼修改完成，請重新登入');window.location.href='../view/login.php'</script>";
    exit();
  }

}
?>