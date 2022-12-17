<?php
require_once('DBPDO.php');

if($_POST['formID']=='creat_list'){
  $name = $_POST['name'];
  $area = $_POST['area'];
  $location = $_POST['location'];
  $category = $_POST['category'];
  $open_time = $_POST['open_time'];
  $close_time = $_POST['close_time'];
  $access = $_POST['access'];
  $price_lunch = $_POST['price_lunch'];
  $price_dinner = $_POST['price_dinner'];
  $memo = $_POST['memo'];
  $link = $_POST['link'];

  $cmd = "INSERT INTO `restaurant_info`(`name`,`area`,`location`,`category`,`open_time`,`close_time`,`access`,`price_lunch`,`price_dinner`,`memo`,`link`,`creat_date`) VALUES('".$name."','".$area."','".$location."','".$category."','".$open_time."','".$close_time."','".$access."','".$price_lunch."','".$price_dinner."','".$memo."','".$link."',NOW())";
  $row = $dbpdo->prepare($cmd);
  $row ->execute();

  header('Location:index.php');
  exit();
}

if($_POST['formID']=='add_mylist'){
  $name = $_POST['name'];
  $area = $_POST['area'];
  $location = $_POST['location'];
  $category = $_POST['category'];
  $open_time = $_POST['open_time'];
  $close_time = $_POST['close_time'];
  $access = $_POST['access'];
  $price_lunch = $_POST['price_lunch'];
  $price_dinner = $_POST['price_dinner'];
  $memo = $_POST['memo'];
  $link = $_POST['link'];
  $rID = $_POST['rID'];

  $cmd = "INSERT INTO `my_restaurant_list`(`rID`,`name`,`area`,`location`,`category`,`open_time`,`close_time`,`access`,`price_lunch`,`price_dinner`,`memo`,`link`,`creat_date`) VALUES('".$rID."','".$name."','".$area."','".$location."','".$category."','".$open_time."','".$close_time."','".$access."','".$price_lunch."','".$price_dinner."','".$memo."','".$link."',NOW())";
  $row = $dbpdo->prepare($cmd);
  $row ->execute();

  header('Location:index.php');
  exit();
}
?>