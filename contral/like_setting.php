<?php
require_once('../DBPDO.php');

if(isset($_SESSION['userID'])){
  $cID = $_POST['cID'];
  $userID = $_SESSION['userID'];
  $sum_like = intval($_POST['sum_like']);
  $sum_like_plus = $sum_like + 1;
  if($sum_like != 0){
    $sum_like_minus = $sum_like - 1;
  }else{
    $sum_like_minus = 0;
  }
  
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

    //更新like總數
    $sql_comment_info = "UPDATE `comment_info` SET `sum_like` = :sum_like WHERE `id` = :cID";
    $stmt_comment_info = $dbpdo->prepare($sql_comment_info);
    $stmt_comment_info->bindParam(':sum_like', $sum_like_plus, PDO::PARAM_INT);
    $stmt_comment_info->bindParam(':cID', $cID, PDO::PARAM_INT);
    $stmt_comment_info->execute();

    echo 'liked';
  }else{
    //刪除狀態
    $sql_delete = "DELETE FROM `comment_like` WHERE `liked_userID` = :liked_userID AND `cID` = :cID";
    $stmt_delete = $dbpdo->prepare($sql_delete);
    $stmt_delete->bindParam(':liked_userID', $userID, PDO::PARAM_INT);
    $stmt_delete->bindParam(':cID', $cID, PDO::PARAM_INT);
    $stmt_delete->execute();

    //更新like總數
    $sql_comment_info = "UPDATE `comment_info` SET `sum_like` = :sum_like WHERE `id` = :cID";
    $stmt_comment_info = $dbpdo->prepare($sql_comment_info);
    $stmt_comment_info->bindParam(':sum_like', $sum_like_minus, PDO::PARAM_INT);
    $stmt_comment_info->bindParam(':cID', $cID, PDO::PARAM_INT);
    $stmt_comment_info->execute();

    echo 'unlike';
  }

  exit();
}else{
  echo 'login';
  exit();
}


?>