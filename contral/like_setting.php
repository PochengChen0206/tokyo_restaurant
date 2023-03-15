<?php
require_once('../DBPDO.php');

$cID = $_POST['cID'];
$userID = $_SESSION['userID'];

//先判斷是否存在此留言的like
$sql = "SELECT `like_status` FROM `comment_like` WHERE `userID` = :userID AND `cID` = :cID";
$stmt = $dbpdo->prepare($sql);
$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
$stmt->bindParam(':cID', $cID, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$status_change = "";
if($result['like_status'] == 0){
  $status_change = 1;
}else{
  $status_change = 0;
}

if(!isset($result['like_status'])){
  //寫入DB
}else{
  //修改status狀態
}

?>