<?php 
require_once('DBPDO.php');

if($_POST['rID']!=""){
  $delete_rID = $_POST['rID'];
  $cmd = "DELETE FROM `my_restaurant_list` WHERE `rID` = '".$delete_rID."'";
  $row_delete=$dbpdo->prepare($cmd);
  $row_delete->execute();
}

// header('Location:admin.php');
exit();
?>