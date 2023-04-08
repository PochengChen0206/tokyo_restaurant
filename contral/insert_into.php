<?php
require_once('../DBPDO.php');
require_once('../contral/function.php');

//新增餐廳
if($_POST['formID'] == 'creat_list'){
  //判斷餐廳名稱是否存在
  $sql = "SELECT `name` FROM `restaurant_info` WHERE `name` = :name";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if(count($result) > 0){
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
  $image1 = $_FILES['image1'];
  $image2 = $_FILES['image2'];
  $image3 = $_FILES['image3'];
  $index_image = $_FILES['index_image'];
  $map_html = $_POST['map_html'];

  //餐廳照片1、2、3
  for($i = 1; $i <= 3; $i++){
    if(${'upload_image'.$i}['size'] > 0){
      if(${'upload_image'.$i}['size'] > 1000000){
        echo alert_topre('上傳照片容量太大');
        exit();
      }else{
        ${'uploaded_path'.$i} = "../images/restaurant_image".$i."/".${'upload_image'.$i}['name'];
        move_uploaded_file(${'upload_image'.$i}['tmp_name'],${'uploaded_path'.$i});
      }
    }else{
      ${'uploaded_path'.$i} = ${'image'.$i};
    }
  }

  //餐廳照片(封面照片)
  if($index_image['size']>0){
    if($index_image['size']>1000000){
      echo alert_topre('上傳照片容量太大');
      exit();
    }else{
      $uploaded_path_index_image = "../images/restaurant_index_image/".$index_image['name'];
      move_uploaded_file($index_image['tmp_name'],$uploaded_path_index_image);
    }
  }else{
    $uploaded_path_index_image = '';
  }

  $cmd = "INSERT INTO `restaurant_info`(`name`, `area`, `location`, `category`, `open_time`, `close_time`, `access`, `price_lunch`, `price_dinner`, `memo`, `link`, `image1`, `image2`, `image3`, `index_image`, `map_html`, `creat_date`) VALUES(:name, :area, :location, :category, :open_time, :close_time, :access, :price_lunch, :price_dinner, :memo, :link, :image1, :image2, :image3, :index_image, :map_html, NOW())";

  $stmt = $dbpdo->prepare($cmd);
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':area', $area, PDO::PARAM_STR);
  $stmt->bindParam(':location', $location, PDO::PARAM_STR);
  $stmt->bindParam(':category', $category, PDO::PARAM_STR);
  $stmt->bindParam(':open_time', $open_time, PDO::PARAM_STR);
  $stmt->bindParam(':close_time', $close_time, PDO::PARAM_STR);
  $stmt->bindParam(':access', $access, PDO::PARAM_STR);
  $stmt->bindParam(':price_lunch', $price_lunch, PDO::PARAM_STR);
  $stmt->bindParam(':price_dinner', $price_dinner, PDO::PARAM_STR);
  $stmt->bindParam(':memo', $memo, PDO::PARAM_STR);
  $stmt->bindParam(':link', $link, PDO::PARAM_STR);
  $stmt->bindParam(':image1', $uploaded_path1, PDO::PARAM_STR);
  $stmt->bindParam(':image2', $uploaded_path2, PDO::PARAM_STR);
  $stmt->bindParam(':image3', $uploaded_path3, PDO::PARAM_STR);
  $stmt->bindParam(':index_image', $uploaded_path_index_image, PDO::PARAM_STR);
  $stmt->bindParam(':map_html', $map_html, PDO::PARAM_STR);
  $stmt->execute();

  echo "<script>alert('新增成功');window.location.href='http://localhost/pocheng/tokyo_restaurant/view/admin.php?cate=edit'</script>";
  exit();
}

//加入我的收藏
if($_POST['formID'] == 'add_mylist'){
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
  $userID = $_SESSION['userID'];

  $cmd = "INSERT INTO `my_restaurant_list`(`userID`, `rID`, `name`, `area`, `location`, `category`, `open_time`, `close_time`, `access`, `price_lunch`, `price_dinner`, `memo`, `link`, `creat_date`) VALUES(:userID, :rID, :name, :area, :location, :category, :open_time, :close_time, :access, :price_lunch, :price_dinner, :memo, :link, NOW())";
  $stmt = $dbpdo->prepare($cmd);
  $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
  $stmt->bindParam(':rID', $rID, PDO::PARAM_INT);
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':area', $area, PDO::PARAM_STR);
  $stmt->bindParam(':location', $location, PDO::PARAM_STR);
  $stmt->bindParam(':category', $category, PDO::PARAM_STR);
  $stmt->bindParam(':open_time', $open_time, PDO::PARAM_STR);
  $stmt->bindParam(':close_time', $close_time, PDO::PARAM_STR);
  $stmt->bindParam(':access', $access, PDO::PARAM_STR);
  $stmt->bindParam(':price_lunch', $price_lunch, PDO::PARAM_STR);
  $stmt->bindParam(':price_dinner', $price_dinner, PDO::PARAM_STR);
  $stmt->bindParam(':memo', $memo, PDO::PARAM_STR);
  $stmt->bindParam(':link', $link, PDO::PARAM_STR);
  $stmt->execute();

  exit();
}

//新增留言
if($_POST['formID'] == 'comment'){
  $rID = $_POST['comment_rID'];
  $userID = $_SESSION['userID'];
  $nickname = $_POST['nickname'];
  $content = $_POST['content'];
  
  $sql = "INSERT INTO `comment_info`(`rID`, `userID`, `nickname`, `content`, `creat_date`) VALUES(:rID, :userID, :nickname, :content, NOW())";
  $stmt = $dbpdo->prepare($sql);
  $stmt->bindParam(':rID', $rID, PDO::PARAM_STR);
  $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
  $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
  $stmt->bindParam(':content', $content, PDO::PARAM_STR);
  $stmt->execute();
  echo "<script>window.location.href='http://localhost/pocheng/tokyo_restaurant/view/restaurant_detail.php?rID=$rID'</script>";
  exit();
}
?>