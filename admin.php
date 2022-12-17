<?php 
require_once('DBPDO.php');
?>
<h3 align="center">管理後台</h3>
<h3>我的收藏</h3>
<form action="delete.php" method="post">
  <table width="100%" border="1" style="border-collapse: collapse;">
    <tr>
      <td width="100" align="center">收藏時間</td> 
      <td width="250" align="center">店名</td>
      <td width="180" align="center">區域</td>
      <td width="100" align="center">地點</td>
      <td width="120" align="center">分類</td>
      <td width="60" align="center">網站</td>
      <td align="center">備註</td>
      <td width="80" align="center">詳細資訊</td>
      <td width="80" align="center">功能</td>
    </tr>
    <?php
    $cmd = "SELECT * FROM `my_restaurant_list` ORDER BY `id` DESC";
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
        <td align="center">
          <?php if($v['link']!=""){ ?>
            <a href="<?=$v['link']?>" target="_blank">前往</a>
          <?php 
          }else{
            echo "暫無<br>網站";
          }?>
        </td>
        <td><?=nl2br($v['memo'])?></td>
        <td align="center"><a href="./restaurant_detail.php?rID=<?=$v['rID']?>">查看</a></td>
        <td align="center">
          <input type="hidden" id="rID" name="rID" value="<?=$v['rID']?>">
          <input type="button" id="delete_mylist<?=$v['rID']?>" onclick="confirmdelete(this.id);" name="delete_mylist" value="刪除">
        </td>
      </tr>
    <?php
    }
    ?>
  </table>
</form>
<table width="100%">
  <tr>
    <td><a type="button" href="./index.php">回首頁</a></td>
  </tr>
</table>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
  function confirmdelete(id) {
    var postinfo = id.split("delete_mylist");
    if (confirm('確認刪除？')) {
      $.ajax({
        url: "delete.php",
        type: "POST",
        data: {"rID": postinfo[1]},
          success: function(res) {
            confirm("已經成功刪除紀錄");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消刪除');
    }
  };
</script>

