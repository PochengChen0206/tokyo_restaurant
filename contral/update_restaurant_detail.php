<?php
require_once('../DBPDO.php');
$rID = $_POST['rID'];
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

$sql = "UPDATE `restaurant_info` SET `name` = :name, `area` = :area, `location` = :location, `category` = :category,`open_time` = :open_time, `close_time` = :close_time,`access` = :access,`price_lunch` = :price_lunch, `price_dinner` = :price_dinner, `memo` = :memo, `link` = :link, `creat_date` = NOW() WHERE `id` = :rID";
$stmt = $dbpdo->prepare($sql);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->bindParam(':area',$area,PDO::PARAM_STR);
$stmt->bindParam(':location',$location,PDO::PARAM_STR);
$stmt->bindParam(':category',$category,PDO::PARAM_STR);
$stmt->bindParam(':open_time',$open_time,PDO::PARAM_STR);
$stmt->bindParam(':close_time',$close_time,PDO::PARAM_STR);
$stmt->bindParam(':access',$access,PDO::PARAM_STR);
$stmt->bindParam(':price_lunch',$price_lunch,PDO::PARAM_STR);
$stmt->bindParam(':price_dinner',$price_dinner,PDO::PARAM_STR);
$stmt->bindParam(':memo',$memo,PDO::PARAM_STR);
$stmt->bindParam(':link',$link,PDO::PARAM_STR);
$stmt->bindParam(':rID',$rID,PDO::PARAM_STR);
$stmt->execute();

echo "<script>alert('餐廳資料已更新');window.location.href='http://localhost/pocheng/tokyo_restaurant/view/admin.php?cate=edit&page=1'</script>";
exit();

?>