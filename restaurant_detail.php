<?php
require_once('DBPDO.php');

$rID=$_GET['rID'];

$row_detail=$dbpdo->prepare("SELECT * FROM `restaurant_info` WHERE `id` = '".$rID."'");
$row_detail->execute();
foreach($row_detail as $k=>$v){
?>

<form action="insert_info.php" method="post">
<h3><?=$v['name']?></h3>
<table width="100%" border="1" style="border-collapse: collapse;">
  <tr height="50">
    <td>地區</td>
    <td><?=$v['area']?></td>
    <td>地點</td>
    <td><?=$v['location']?></td>
    <td>分類</td>
    <td><?=$v['category']?></td>
  </tr>
  <tr height="50">
    <td>開始營業時間</td>
    <td><?=$v['open_time']?></td>
    <td>結束營業時間</td>
    <td><?=$v['close_time']?></td>
    <td>交通</td>
    <td><?=$v['access']?></td>
  </tr>
  <tr height="50">
    <td>備註</td>
    <td colspan="5"><?=$v['memo']?></td>
  </tr>
  <tr height="50">
    <td>午餐價格</td>
    <td><?=$v['price_lunch']?></td>
    <td>晚餐價格</td>
    <td><?=$v['price_dinner']?></td>
    <td>餐廳網站</td>
    <td>
      <?php if($v['link']!=""){ ?>
      <a href="<?=$v['link']?>" target="_blank">前往</a>
      <?php 
      }else{
        echo "暫無<br>網站";
      }?>
    </td>
  </tr>
</table>
<input type="hidden" name="formID" value="add_mylist">
<input type="hidden" name="name" value="<?=$v['name']?>">
<input type="hidden" name="area" value="<?=$v['area']?>">
<input type="hidden" name="location" value="<?=$v['location']?>">
<input type="hidden" name="category" value="<?=$v['category']?>">
<input type="hidden" name="open_time" value="<?=$v['open_time']?>">
<input type="hidden" name="close_time" value="<?=$v['close_time']?>">
<input type="hidden" name="access" value="<?=$v['access']?>">
<input type="hidden" name="memo" value="<?=$v['memo']?>">
<input type="hidden" name="price_lunch" value="<?=$v['price_lunch']?>">
<input type="hidden" name="price_dinner" value="<?=$v['price_dinner']?>">
<input type="hidden" name="link" value="<?=$v['link']?>">
<input type="hidden" name="rID" value="<?=$v['id']?>">

<input type="submit" value="加入我的收藏">
</form>
<?php } ?>
<a type="button" href="./index.php">回首頁</a>