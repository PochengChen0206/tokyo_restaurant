<?php 
require_once('../DBPDO.php');

if($_POST['admin_rID']!=""){
  $delete_rID = $_POST['admin_rID'];
  $cmd = "DELETE FROM `my_restaurant_list` WHERE `rID` = :rID";
  $stmt_delete=$dbpdo->prepare($cmd);
  $stmt_delete->bindParam(':rID',$delete_rID,PDO::PARAM_STR);
  $stmt_delete->execute();
}

exit();
?>