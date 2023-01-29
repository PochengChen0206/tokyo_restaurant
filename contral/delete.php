<?php 
require_once('../DBPDO.php');

//刪除我的收藏
if($_POST['mylist_rID']!=""){
  $delete_rID = $_POST['mylist_rID'];
  $sql = "DELETE FROM `my_restaurant_list` WHERE `rID` = :rID";
  $stmt_delete=$dbpdo->prepare($sql);
  $stmt_delete->bindParam(':rID',$delete_rID,PDO::PARAM_STR);
  $stmt_delete->execute();
}

//刪除餐廳資訊
if($_POST['admin_id']!=""){
  $delete_id = $_POST['admin_id'];

  //刪除餐廳資訊寫入restaurant_info_delete
  $sql1 = "INSERT INTO `restaurant_info_delete`(`name`,`area`,`location`,`category`,`open_time`,`close_time`,`access`,`price_lunch`,`price_dinner`,`memo`,`link`,`creat_date`) SELECT `name`,`area`,`location`,`category`,`open_time`,`close_time`,`access`,`price_lunch`,`price_dinner`,`memo`,`link`,`creat_date` FROM `restaurant_info` WHERE `id` = :id";
  $stmt=$dbpdo->prepare($sql1);
  $stmt->bindParam(':id',$delete_id,PDO::PARAM_STR);
  $stmt->execute();

  $sql2 = "DELETE FROM `restaurant_info` WHERE `id` = :id";
  $stmt_delete=$dbpdo->prepare($sql2);
  $stmt_delete->bindParam(':id',$delete_id,PDO::PARAM_STR);
  $stmt_delete->execute();
}

//刪除留言
if($_POST['comment_id']!=""){
  $delete_id = $_POST['comment_id'];
  $sql = "DELETE FROM `comment_info` WHERE `id` = :id";
  $stmt_delete=$dbpdo->prepare($sql);
  $stmt_delete->bindParam(':id',$delete_id,PDO::PARAM_STR);
  $stmt_delete->execute();
}


exit();
?>