<?php
require_once('../DBPDO.php');
require_once('../function.php');

//新增餐廳
if($_POST['formID']=='creat_list'){
  // $name = $_POST['name'];
  //判斷餐廳名稱是否存在
  $sql ="SELECT `name` FROM `restaurant_info` WHERE `name` = :name";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if(count($row) > 0){
    echo alert_topre('輸入的餐廳已經存在');
    exit();
  }else{
    $name = $_POST['name'];
  }

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

  $cmd = "INSERT INTO `restaurant_info`(`name`,`area`,`location`,`category`,`open_time`,`close_time`,`access`,`price_lunch`,`price_dinner`,`memo`,`link`,`creat_date`) VALUES(:name,:area,:location,:category,:open_time,:close_time,:access,:price_lunch,:price_dinner,:memo,:link,NOW())";

  $row = $dbpdo->prepare($cmd);
  $row->bindParam(':name',$name,PDO::PARAM_STR);
  $row->bindParam(':area',$area,PDO::PARAM_STR);
  $row->bindParam(':location',$location,PDO::PARAM_STR);
  $row->bindParam(':category',$category,PDO::PARAM_STR);
  $row->bindParam(':open_time',$open_time,PDO::PARAM_STR);
  $row->bindParam(':close_time',$close_time,PDO::PARAM_STR);
  $row->bindParam(':access',$access,PDO::PARAM_STR);
  $row->bindParam(':price_lunch',$price_lunch,PDO::PARAM_STR);
  $row->bindParam(':price_dinner',$price_dinner,PDO::PARAM_STR);
  $row->bindParam(':memo',$memo,PDO::PARAM_STR);
  $row->bindParam(':link',$link,PDO::PARAM_STR);
  $row ->execute();

  echo "<script>alert('新增成功');window.location.href='http://localhost/pocheng/tokyo_restaurant/view/admin.php?cate=edit'</script>";
  exit();
}

//加入我的收藏
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

  $cmd = "INSERT INTO `my_restaurant_list`(`rID`,`name`,`area`,`location`,`category`,`open_time`,`close_time`,`access`,`price_lunch`,`price_dinner`,`memo`,`link`,`creat_date`) VALUES(:rID,:name,:area,:location,:category,:open_time,:close_time,:access,:price_lunch,:price_dinner,:memo,:link,NOW())";
  $row = $dbpdo->prepare($cmd);
  $row->bindParam(':rID',$rID,PDO::PARAM_INT);
  $row->bindParam(':name',$name,PDO::PARAM_STR);
  $row->bindParam(':area',$area,PDO::PARAM_STR);
  $row->bindParam(':location',$location,PDO::PARAM_STR);
  $row->bindParam(':category',$category,PDO::PARAM_STR);
  $row->bindParam(':open_time',$open_time,PDO::PARAM_STR);
  $row->bindParam(':close_time',$close_time,PDO::PARAM_STR);
  $row->bindParam(':access',$access,PDO::PARAM_STR);
  $row->bindParam(':price_lunch',$price_lunch,PDO::PARAM_STR);
  $row->bindParam(':price_dinner',$price_dinner,PDO::PARAM_STR);
  $row->bindParam(':memo',$memo,PDO::PARAM_STR);
  $row->bindParam(':link',$link,PDO::PARAM_STR);
  $row ->execute();

  exit();
}
?>