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
$upload_image1 = $_FILES['upload_image1'];
$upload_image2 = $_FILES['upload_image2'];
$upload_image3 = $_FILES['upload_image3'];
$upload_index_image = $_FILES['upload_index_image'];
$image1 = $_POST['image1'];
$image2 = $_POST['image2'];
$image3 = $_POST['image3'];
$index_image = $_POST['index_image'];
$map_html = $_POST['map_html'];

 //餐廳照片1
 if($upload_image1['size']>0){
  if($upload_image1['size']>1000000){
    echo alert_topre('上傳照片容量太大');
    exit();
  }else{
    $uploaded_path1 = "../images/restaurant_image1/".$upload_image1['name'];
    move_uploaded_file($upload_image1['tmp_name'],$uploaded_path1);
  }
}else{
  $uploaded_path1 = $image1;
}

//餐廳照片2
if($upload_image2['size']>0){
  if($upload_image2['size']>1000000){
    echo alert_topre('上傳照片容量太大');
    exit();
  }else{
    $uploaded_path2 = "../images/restaurant_image2/".$upload_image2['name'];
    move_uploaded_file($upload_image2['tmp_name'],$uploaded_path2);
  }
}else{
  $uploaded_path2 = $image2;
}

//餐廳照片3
if($upload_image3['size']>0){
  if($upload_image3['size']>1000000){
    echo alert_topre('上傳照片容量太大');
    exit();
  }else{
    $uploaded_path3 = "../images/restaurant_image3/".$upload_image3['name'];
    move_uploaded_file($upload_image3['tmp_name'],$uploaded_path3);
  }
}else{
  $uploaded_path3 = $image3;
}

//餐廳照片(封面照片)
if($upload_index_image['size']>0){
  if($upload_index_image['size']>1000000){
    echo alert_topre('上傳照片容量太大');
    exit();
  }else{
    $uploaded_path_index_image = "../images/restaurant_index_image/".$upload_index_image['name'];
    move_uploaded_file($upload_index_image['tmp_name'],$uploaded_path_index_image);
  }
}else{
  $uploaded_path_index_image = $index_image;
}

$sql = "UPDATE `restaurant_info` SET `name` = :name, `area` = :area, `location` = :location, `category` = :category,`open_time` = :open_time, `close_time` = :close_time,`access` = :access,`price_lunch` = :price_lunch, `price_dinner` = :price_dinner, `memo` = :memo, `link` = :link, `image1` = :image1, `image2` = :image2, `image3` = :image3, `index_image` = :index_image, `map_html` = :map_html, `update_date` = NOW() WHERE `id` = :rID";
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
$stmt->bindParam(':image1', $uploaded_path1, PDO::PARAM_STR);
$stmt->bindParam(':image2', $uploaded_path2, PDO::PARAM_STR);
$stmt->bindParam(':image3', $uploaded_path3, PDO::PARAM_STR);
$stmt->bindParam(':index_image', $uploaded_path_index_image, PDO::PARAM_STR);
$stmt->bindParam(':map_html', $map_html, PDO::PARAM_STR);
$stmt->execute();


echo "<script>alert('餐廳資料已更新');window.location.href='http://localhost/pocheng/tokyo_restaurant/view/admin.php?cate=edit&page=1'</script>";
exit();

?>