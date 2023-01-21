<?php 
require_once('../DBPDO.php');
?>
<!doctype html>
<html lang="en">
<?php require_once('../view/head.php'); ?>

<body>
  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <?php require_once('../view/nav.php'); ?>

  <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mx-auto text-center">
          <div class="intro-wrap">
            <h2 class="text-white">管理後台</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="untree_co-section">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-3">
          <div class="feature-1">
            <ul class="list-unstyled clearfix">
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="http://localhost/pocheng/tokyo_restaurant/view/admin.php?cate=new">餐廳新增</a></li>
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="http://localhost/pocheng/tokyo_restaurant/view/admin.php?cate=edit">餐廳管理</a></li>
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="http://localhost/pocheng/tokyo_restaurant/view/admin.php?cate=member">會員管理</a></li>
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="http://localhost/pocheng/tokyo_restaurant/view/admin.php?cate=report">分享文章管理</a></li>
            </ul>
          </div>
        </div>

        <?php if(!isset($_GET['cate'])){ ?>
        <div class="col-lg-9">
          <h2 class="section-title text-left mb-4">管理後台</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
          <p class="mb-4"></p>
          <ul class="list-unstyled two-col clearfix">
            <li>Outdoor recreation activities</li>
            <li>Airlines</li>
            <li>Car Rentals</li>
            <li>Cruise Lines</li>
            <li>Hotels</li>
            <li>Railways</li>
            <li>Travel Insurance</li>
            <li>Package Tours</li>
            <li>Insurance</li>
            <li>Guide Books</li>
          </ul>
        </div>
        <?php } ?>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='new'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">餐廳新增</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

            <p class="mb-4"></p>

            <ul class="list-unstyled two-col clearfix">
              <li>Outdoor recreation activities</li>
              <li>Airlines</li>
              <li>Car Rentals</li>
              <li>Cruise Lines</li>
              <li>Hotels</li>
              <li>Railways</li>
              <li>Travel Insurance</li>
              <li>Package Tours</li>
              <li>Insurance</li>
              <li>Guide Books</li>
            </ul>
          </div>
        <?php } ?>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='edit'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">餐廳管理</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

            <p class="mb-4"></p>

            <ul class="list-unstyled two-col clearfix">
              <li>Outdoor recreation activities</li>
              <li>Airlines</li>
              <li>Car Rentals</li>
              <li>Cruise Lines</li>
              <li>Hotels</li>
              <li>Railways</li>
              <li>Travel Insurance</li>
              <li>Package Tours</li>
              <li>Insurance</li>
              <li>Guide Books</li>
            </ul>
          </div>
        <?php } ?>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='member'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">會員管理</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

            <p class="mb-4"></p>

            <ul class="list-unstyled two-col clearfix">
              <li>Outdoor recreation activities</li>
              <li>Airlines</li>
              <li>Car Rentals</li>
              <li>Cruise Lines</li>
              <li>Hotels</li>
              <li>Railways</li>
              <li>Travel Insurance</li>
              <li>Package Tours</li>
              <li>Insurance</li>
              <li>Guide Books</li>
            </ul>
          </div>
        <?php } ?>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='report'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">分享文章管理</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

            <p class="mb-4"></p>

            <ul class="list-unstyled two-col clearfix">
              <li>Outdoor recreation activities</li>
              <li>Airlines</li>
              <li>Car Rentals</li>
              <li>Cruise Lines</li>
              <li>Hotels</li>
              <li>Railways</li>
              <li>Travel Insurance</li>
              <li>Package Tours</li>
              <li>Insurance</li>
              <li>Guide Books</li>
            </ul>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <?php require_once('../view/footer.php'); ?>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.animateNumber.min.js"></script>
  <script src="../js/jquery.waypoints.min.js"></script>
  <script src="../js/jquery.fancybox.min.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/moment.min.js"></script>
  <script src="../js/daterangepicker.js"></script>
  <script src="../js/typed.js"></script>  
  <script src="../js/custom.js"></script>
</body>
</html>
<h3 align="center">管理後台</h3>
<h3>我的收藏</h3>
<table width="100%" border="1px" style="border-collapse: collapse;">
  <tr>
    <td width="100px" align="center">收藏時間</td> 
    <td width="250px" align="center">店名</td>
    <td width="180px" align="center">區域</td>
    <td width="100px" align="center">地點</td>
    <td width="120px" align="center">分類</td>
    <td width="60px" align="center">網站</td>
    <td align="center">備註</td>
    <td width="80px" align="center">詳細資訊</td>
    <td width="80px" align="center">功能</td>
  </tr>
  <?php
  $cmd = "SELECT * FROM `my_restaurant_list` ORDER BY `id` DESC";
  $row_new=$dbpdo->prepare($cmd);
  $row_new->execute();
  foreach($row_new as $k=>$v){
  ?>
    <tr height="50px">
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
      <td align="center"><a href="../view/restaurant_detail.php?rID=<?=$v['rID']?>">查看</a></td>
      <td align="center">
        <input type="button" id="delete_mylist<?=$v['rID']?>" onclick="confirmdelete(this.id);" name="delete_mylist" value="刪除">
      </td>
    </tr>
  <?php
  }
  ?>
</table>
<br>
<table width="100%">
  <tr>
    <td><a type="button" href="../index.php">回首頁</a></td>
  </tr>
</table>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->


