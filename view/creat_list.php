<?php
require_once('../DBPDO.php');
?>

<form method="post" action="../contral/insert_info.php">
  <table width="100%" align="center">
    <tr>
      <td><h3>新增餐廳</h3></td>
    </tr>
    <tr>
      <td width="120">餐廳名稱</td>
      <td><input type="text" name="name" id="name" size="32"></td>
    </tr>
    <tr>
      <td>區域</td>
      <td>
        <select name="area" id="area">
          <option value="">請選擇區域</option>
        <?php 
        $row=$dbpdo->prepare("SELECT * FROM `area_info`");
        $row->execute();
        foreach($row as $k=>$v){
        ?>
          <option value="<?=$v['area']?>"><?=$v['area']?></option>
        <?php 
        }
        ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>地點</td>
      <td><input type="text" name="location" size="20"></td>
    </tr>
    <tr>
      <td>分類</td>
      <td>
        <select name="category" id="category">
          <option value="">請選擇分類</option>
        <?php 
        $row=$dbpdo->prepare("SELECT * FROM `categories_info`");
        $row->execute();
        foreach($row as $k=>$v){
        ?>
          <option value="<?=$v['cat_name']?>"><?=$v['cat_name']?></option>
        <?php 
        }
        ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>開始營業時間</td>
      <td><input type="text" name="open_time" size="20"></td>
    </tr>
    <tr>
      <td>結束營業時間</td>
      <td><input type="text" name="close_time" size="20"></td>
    </tr>
    <tr>
      <td>交通</td>
      <td><input type="text" name="access" size="32"></td>
    </tr>
    <tr>
      <td>午餐預算</td>
      <td>
        <select name="price_lunch" id="price_lunch">
          <option value="">請選擇分類</option>
          <?php 
          $row=$dbpdo->prepare("SELECT * FROM `price_range`");
          $row->execute();
          foreach($row as $k=>$v){
          ?>
            <option value="<?=$v['price_range']?>"><?=$v['price_range']?></option>
          <?php 
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>晚餐預算</td>
      <td>
        <select name="price_dinner" id="price_dinner">
          <option value="">請選擇分類</option>
          <?php 
          $row=$dbpdo->prepare("SELECT * FROM `price_range`");
          $row->execute();
          foreach($row as $k=>$v){
          ?>
            <option value="<?=$v['price_range']?>"><?=$v['price_range']?></option>
          <?php 
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>備註</td>
      <td><textarea name="memo" id="memo" cols="32" rows="10"></textarea></td>
    </tr>
    <tr>
      <td>餐廳網站</td>
      <td><input type="text" name="link" size="32"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="送出"></td>
    </tr>
  </table>
  <a type="button" href="../index.php">回首頁</a>
  <input type="hidden" id="formID" name="formID" value="creat_list">
</form>

