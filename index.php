<?php
require_once('DBPDO.php');
?>
<table width="100%">
  <tr>
    <td align="right"><button>登入</button></td>
  </tr>
</table>
<h3 align="center">東京美食收藏</h3>
<form action="search.php" method="post">
<table width="60%" align="center">
  <tr>
    <td width="180">區域</td>
    <td width="180">分類</td>
    <td>預算</td>
  </tr>
  <tr>
    <td>
      <select name="search_area" id="search_area" height="100">
      <option value="">請選擇區域</option>
      <?php 
      $row_area=$dbpdo->prepare("SELECT * FROM `area_info`");
      $row_area->execute();
      foreach($row_area as $k1=>$v1){
      ?>
        <option value="<?=$v1['area']?>"><?=$v1['area']?></option>
      <?php 
      }
      ?>
      </select>
    </td>
    <td>
      <select name="search_category" id="search_category">
        <option value="">請選擇分類</option>
      <?php 
      $row_cat=$dbpdo->prepare("SELECT * FROM `categories_info`");
      $row_cat->execute();
      foreach($row_cat as $k2=>$v2){
      ?>
        <option value="<?=$v2['cat_name']?>"><?=$v2['cat_name']?></option>
      <?php 
      }
      ?>
      </select>
    </td>
    <td>
      下限<input type="text" name="search_price_lower" size="6">~
      上限<input type="text" name="search_price_max" size="6">
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center"><input type="submit" value="搜尋"></td>
  </tr>
</table>
</form>
<br>
<h3>最新投稿</h3>
<table width="100%" border="1" cellpadding="0" style="border-collapse: collapse;">
  <tr>
    <td width="100" align="center">更新時間</td> 
    <td width="250" align="center">店名</td>
    <td width="180" align="center">區域</td>
    <td width="100" align="center">地點</td>
    <td width="120" align="center">分類</td>
    <td width="150" align="center">交通</td>
    <td width="60" align="center">網站</td>
    <td align="center">備註</td>
    <td width="80" align="center">詳細資訊</td>
  </tr>
  <?php
  $cmd = "SELECT * FROM `restaurant_info` ORDER BY `id` DESC LIMIT 9";
  $row_new=$dbpdo->prepare($cmd);
  $row_new->execute();
  foreach($row_new as $k=>$v){
  ?>
  <tr height="50">
    <td><?=date("Y/m/d",strtotime($v['creat_date']))?></td>
    <td><?=$v['name']?></td>
    <td align="center"><?=$v['area']?></td>
    <td align="center"><?=$v['location']?></td>
    <td align="center"><?=$v['category']?></td>
    <td align="center"><?=$v['access']?></td>
    <td align="center">
      <?php if($v['link']!=""){ ?>
      <a href="<?=$v['link']?>" target="_blank">前往</a>
      <?php 
      }else{
        echo "暫無<br>網站";
      }?>
    </td>
    <td><?=nl2br($v['memo'])?></td>
    <td align="center"><a href="./restaurant_detail.php?rID=<?=$v['id']?>">查看</a></td>
  </tr>
  <?php
  }
  ?>
</table>
<table width="100%">
  <tr>
    <td><a type="button" href="./restaurant_detail.php">查看更多</a></td>
  </tr>
  <tr>
    <td><a type="button" href="./creat_list.php">新增餐廳</a></td>
  </tr>
  <tr>
    <td><a type="button" href="./admin.php">管理系統</a></td>
  </tr>
</table>