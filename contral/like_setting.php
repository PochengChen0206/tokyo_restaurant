<?php
require_once('../DBPDO.php');

if(isset($_SESSION['userID'])){
  $cID = $_POST['cID'];
  $userID = $_SESSION['userID'];
  
  //先判斷是否存在此留言的like
  $sql = "SELECT `like_status` FROM `comment_like` WHERE `liked_userID` = :liked_userID AND `cID` = :cID";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':liked_userID', $userID, PDO::PARAM_INT);
  $stmt->bindParam(':cID', $cID, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
  $status_change = "";
  if(empty($result)){
    $status_change = 1;
  }else{
    $status_change = 0;
  }

  //判斷是否有like過
  if(!isset($result['like_status'])){
    //寫入DB
    $sql_insert = "INSERT INTO `comment_like`(`liked_userID`, `cID`, `like_status`, `created_at`) VALUES(:liked_userID, :cID, '".$status_change."', NOW())";
    $stmt = $dbpdo->prepare($sql_insert);
    $stmt->bindParam(':liked_userID', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':cID', $cID, PDO::PARAM_INT);
    $stmt->execute();

    echo 'liked';
  }else{
    //刪除狀態
    $sql_delete = "DELETE FROM `comment_like` WHERE `liked_userID` = :liked_userID AND `cID` = :cID";
    $stmt_delete = $dbpdo->prepare($sql_delete);
    $stmt_delete->bindParam(':liked_userID', $userID, PDO::PARAM_INT);
    $stmt_delete->bindParam(':cID', $cID, PDO::PARAM_INT);
    $stmt_delete->execute();

    echo 'unlike';
  }

  exit();
}else{
  echo 'login';
  exit();
}


?>