<?php
require_once('../DBPDO.php');

$rID=$_GET['rID'];

$row_detail=$dbpdo->prepare("SELECT * FROM `restaurant_info` WHERE `id` = :rID");
$row_detail->bindParam(':rID',$rID,PDO::PARAM_STR);
$row_detail->execute();
foreach($row_detail as $k=>$v){
?>
  <h3><?=$v['name']?></h3>
  <table width="100%" border="1px" style="border-collapse: collapse;">
    <tr height="50px">
      <td>地區</td>
      <td><?=$v['area']?></td>
      <td>地點</td>
      <td><?=$v['location']?></td>
      <td>分類</td>
      <td><?=$v['category']?></td>
    </tr>
    <tr height="50px">
      <td>開始營業時間</td>
      <td><?=$v['open_time']?></td>
      <td>結束營業時間</td>
      <td><?=$v['close_time']?></td>
      <td>交通</td>
      <td><?=$v['access']?></td>
    </tr>
    <tr height="50px">
      <td>備註</td>
      <td colspan="5"><?=nl2br($v['memo'])?></td>
    </tr>
    <tr height="50px">
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
  <?php

  $row_check=$dbpdo->prepare("SELECT `rID` FROM `my_restaurant_list` WHERE `rID` = :rID");
  $row_check->bindParam(':rID',$rID,PDO::PARAM_STR);
  $row_check->execute();
  //取得my_restaurant_list裡面的rID判斷是否已經存在
  $check_rID = $row_check->fetch(PDO::FETCH_ASSOC);
  
  if(isset($check_rID['rID'])){
  ?>
    <input type="button" id="check_mylist" name="check_mylist" value="已收藏">
  <?php }else{ ?>
    <input type="button" id="add_mylist_<?=$v['id']?>" name="add_mylist" value="加入我的收藏" onclick="addto_mylist(this.id);">
  <?php } ?>
  <!-- 下方ajax post用的變數 -->
  <input type="hidden" id="rID" name="rID" value="<?=$v['id']?>">
  <input type="hidden" id="name" name="name" value="<?=$v['name']?>">
  <input type="hidden" id="area" name="area" value="<?=$v['area']?>">
  <input type="hidden" id="location" name="location" value="<?=$v['location']?>">
  <input type="hidden" id="category" name="category" value="<?=$v['category']?>">
  <input type="hidden" id="open_time" name="open_time" value="<?=$v['open_time']?>">
  <input type="hidden" id="close_time" name="close_time" value="<?=$v['close_time']?>">
  <input type="hidden" id="access" name="access" value="<?=$v['access']?>">
  <input type="hidden" id="price_lunch" name="price_lunch" value="<?=$v['price_lunch']?>">
  <input type="hidden" id="price_dinner" name="price_dinner" value="<?=$v['price_dinner']?>">
  <input type="hidden" id="link" name="link" value="<?=$v['link']?>">
  <input type="hidden" id="memo" name="memo" value="<?=$v['memo']?>">
<?php
}   
?>
<br>
<a type="button" href="../index.php">回首頁</a>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
  function addto_mylist(id) {
    let rID = $('#rID').val();
    let name = $('#name').val();
    let area = $('#area').val();
    let location = $('#location').val();
    let category = $('#category').val();
    let open_time = $('#open_time').val();
    let close_time = $('#close_time').val();
    let access = $('#access').val();
    let memo = $('#memo').val();
    let price_lunch = $('#price_lunch').val();
    let price_dinner = $('#price_dinner').val();
    let link = $('#link').val();

    if (confirm('確認加入我的收藏？')) {
      $.ajax({
        url: "../contral/insert_into.php",
        type: "POST",
        data: {
              "formID": "add_mylist",
              "rID": rID,
              "name": name,
              "area": area,
              "location": location,
              "category": category,
              "open_time": open_time,
              "close_time": close_time,
              "access": access,
              "memo": memo, //memo不能直接存$v['memo']不然會報錯
              "price_lunch": price_lunch,
              "price_dinner": price_dinner,
              "link": link
              },
          success: function(res) {
            confirm("已經成功加入我的收藏");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消加入我的收藏');
    }
  };
</script>