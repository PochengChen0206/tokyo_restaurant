<?php
require_once('DBPDO.php');

$sql = "";
if($_POST['search_area']){
  $sql = "`area`= '".$_POST['search_area']."'";
}
if($_POST['search_category']){
  $sql .= "`category`= '".$_POST['search_category']."'";
}
?>
<h3>搜尋結果</h3>
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
  $cmd = "SELECT * FROM `restaurant_info` WHERE $sql ORDER BY `id` DESC";
  
  $row_search = $dbpdo->prepare($cmd);
  $row_search->execute();
  foreach($row_search as $k=>$v){
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
<a type="button" href="./index.php">回首頁</a>