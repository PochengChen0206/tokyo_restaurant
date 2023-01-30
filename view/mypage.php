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
            <h2 class="text-white">會員中心</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  //個人資料
  $sql = "SELECT * FROM `user_info` WHERE `userID` = '".$_SESSION['userID']."'";
  $stmt = $dbpdo->prepare($sql);
  $stmt->execute();
  $result_userinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result_userinfo as $k=>$v){
    $user_name = $v['user_name'];
    $nickname = $v['nickname'];
    $email = $v['email'];
    if($v['user_image']!=""){
      $user_image = $v['user_image'];
    }else{
      $user_image = '../images/image_prepare.jpg';
    }
  }
  ?>
  <div class="untree_co-section">
    <div class="container">
      <div class="row justify-content-between align-items-start">
        <div class="col-lg-3">
          <div class="mb-5 feature-1">
            <div class="mb-3">
              <div style="width: 150px;height:150px; border-radius: 20px; position: relative; overflow: hidden;">
                <img src="<?=$user_image?>" alt="Image" class="mb-4" style="position: absolute; width: 100%; top: 50%; left: 50%; transform: translate(-50%, -50%);">
              </div>
            </div>
            <div class="mb-3">
              <p>暱稱 <?=$nickname?></p>
            </div>
            <div class="mb-3">
              <p>目前的預約_件</p>
            </div>
          </div>
          
          <div class="feature-1">
            <ul class="list-unstyled clearfix">
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="../view/mypage.php?cate=userinfo">個人資料設定</a></li>
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="../view/mypage.php?cate=collect&page=1">我的收藏</a></li>
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="../view/mypage.php?cate=share&page=1">我的留言</a></li>
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="../view/mypage.php?cate=reservation">預約餐廳</a></li>
            </ul>
          </div>
        </div>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='userinfo'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">個人資料設定</h2>
              <form class="contact-form">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">姓名</label>
                      <input class="form-control" type="text" value="<?=$user_name?>" readonly>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">暱稱</label>
                      <input class="form-control" type="text" value="<?=$nickname?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="text-black">電子信箱</label>
                  <input class="form-control" type="email"  value="<?=$email?>" readonly>
                </div>
                <div class="row justify-content-center">
                  <a class="col-3 btn btn-primary mt-2" href="../view/mypage.php?cate=setting">修改個人資料</a>
                </div>
              </form>
          </div>
        <?php } ?>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='setting'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">修改個人資料</h2>
            <?php  
            $sql = "SELECT * FROM `user_info` WHERE `userID` = '".$_SESSION['userID']."'";
            $stmt = $dbpdo->prepare($sql);
            $stmt->execute();
            $result_userinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result_userinfo as $k=>$v){
            ?>
              <form class="contact-form" data-aos="fade-up" data-aos-delay="200" action="../contral/setting_userinfo.php" method="post" enctype="multipart/form-data" onsubmit="return setting_check();">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">姓名</label>
                      <input class="form-control" type="text" id="setting_user_name" name="setting_user_name" value="<?=$v['user_name']?>" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">暱稱</label>
                      <input class="form-control" type="text" id="setting_nickname" name="setting_nickname" value="<?=$v['nickname']?>" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="text-black">電子信箱</label>
                  <input class="form-control" type="email" id="setting_email"  name="setting_email" value="<?=$v['email']?>" required>
                </div>
                <div class="form-group">
                  <label class="text-black">個人頭像</label>
                  <input type="file" name="opload_image" accept="image/*">
                  <input type="hidden" name="user_image" value="<?=$v['user_image']?>">
                </div>
                <div class="row justify-content-center">
                  <button type="submit" class="col-3 btn btn-primary mt-2">更新個人資料</button>
                </div>
                <div class="row justify-content-center">
                  <a class="col-3 btn btn-primary mt-2" href="../view/mypage.php?cate=userinfo">返回個人資料設定</a>
                </div>
              </form>
            <?php } ?>
          </div>
        <?php } ?>



        <?php if(isset($_GET['cate']) && $_GET['cate']=='collect'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">我的收藏</h2>
            <?php
            $num = 5; //每頁呈現筆數 
            $stmt = $dbpdo->prepare("SELECT `id` FROM `my_restaurant_list` WHERE `userID` = '".$_SESSION['userID']."'");
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $total_list = count($row);
            $max_page = ceil($total_list/$num);

            if(isset($_GET['page']) && $_GET['page'] > 0){
              $page = $_GET['page'];
            }else{
              $page = 1;
            }
            $start_no = ($page - 1) * $num;
            $sql = "SELECT a.*,b.`index_image` FROM `my_restaurant_list` a INNER jOIN `restaurant_info` b ON a.`rID` = b.`id` WHERE a.`userID` = '".$_SESSION['userID']."' ORDER BY `id` DESC LIMIT $start_no, $num";
            $stmt =  $dbpdo->prepare($sql);
            $stmt->execute();
            $result_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($total_list>0){
              $img = "";
              foreach($result_list as $k=>$v){
                if($v['index_image']!=""){
                  $img = '.'.$v['index_image'];
                }else{
                  $img = "../images/image_prepare.jpg";
                }
              ?>
                <div class="row ml-2">
                  <div class="col-3">
                    <div>
                      <a href="../view/restaurant_detail.php?rID=<?=$v['rID']?>&page=1">
                        <img src="<?=$img?>" alt="Image" class="img-fluid mb-4 rounded-20">
                      </a>
                    </div>
                  </div>
                  <div class="col-9">
                    <h4><?=$v['name']?></h4>
                    <div>
                      <ul class="list-unstyled two-col clearfix">
                        <li>區域：<?=$v['area']?></li>
                        <li>地點：<?=$v['location']?></li>
                        <li>分類：<?=$v['category']?></li>
                        <li>收藏時間：<?=date("Y/m/d",strtotime($v['creat_date']))?></li>
                      </ul>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <a class="c-hover" href="../view/restaurant_detail.php?rID=<?=$v['rID']?>&page=1">詳細資訊</a>
                      </div>
                      <div class="col-6">
                        <input type="button" id="delete_mylist<?=$v['rID']?>" onclick="confirmdelete(this.id);" name="delete_mylist" value="刪除收藏">
                      </div>
                    </div>
                  </div>
                </div>
              <?php 
                }
              ?>
                <div class="row justify-content-center">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li class="page-item <?=$_GET['page']==1?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=collect&page=1">第一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==1?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=collect&page=<?($page-1)?>">前一頁</a>
                      </li>
                      <?php for($i=1;$i<=$max_page;$i++){ ?>
                        <li class="page-item <?= $_GET['page']==$i?'active':''?>">
                          <a class="page-link" href="../view/mypage.php?cate=collect&page=<?=$i?>"><?=$i?></a>
                        </li>
                      <?php } ?>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=collect&page=<?=($page+1)?>">下一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=collect&page=<?=$max_page?>">最後一頁</a>
                      </li>
                    </ul>
                  </nav>
                </div>
              <?php
              }else{
              ?>
              <div class="row ml-2"><p>目前沒有收藏</p></div>
              <?php  
              }
              ?>
          </div>
        <?php } ?>
        <?php if(isset($_GET['cate']) && $_GET['cate']=='share'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">我的留言</h2>
            <?php
            $num = 5; //每頁呈現筆數 
            $stmt = $dbpdo->prepare("SELECT `id` FROM `comment_info` WHERE `userID` = '".$_SESSION['userID']."'");
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $total_list = count($row);
            $max_page = ceil($total_list/$num);

            if(isset($_GET['page']) && $_GET['page'] > 0){
              $page = $_GET['page'];
            }else{
              $page = 1;
            }
            $start_no = ($page - 1) * $num;
            $sql = "SELECT a.*, c.`index_image`, c.`name` FROM `comment_info` a INNER jOIN `user_info` b ON a.`userID` = b.`userID` INNER JOIN `restaurant_info` c ON a.`rID` = c.`id` WHERE a.`userID` = '".$_SESSION['userID']."' ORDER BY a.`id` DESC LIMIT $start_no, $num";
            $stmt =  $dbpdo->prepare($sql);
            $stmt->execute();
            $result_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($total_list>0){
              $image = "";
              foreach($result_list as $k=>$v){
                if($v['index_image']!=""){
                  $image = '.'.$v['index_image'];
                }else{
                  $image = './images/image_prepare.jpg';
                }
              ?>
                <div class="row ml-2">
                  <div class="col-3">
                    <a href="../view/restaurant_detail.php?rID=<?=$v['rID']?>&page=1"><img src="<?=$image?>" alt="Image" class="img-fluid mb-4 rounded-20"></a>  
                  </div>
                  <div class="col-9">
                    <h4><?=$v['nickname']?></h4>
                    <div>
                      <ul class="list-unstyled two-col clearfix">
                        <li>餐廳名稱：<?=$v['name']?></li>
                        <li>建立時間：<?=$v['creat_date']?></li>
                        <li>留言內容：<?=nl2br($v['content'])?></li>
                      </ul>
                    </div>
                    <div class="row justify-content-end">
                      <input type="button" id="delete_comment<?=$v['id']?>" onclick="delete_comment(this.id);" name="delete_comment" value="刪除留言">
                    </div>
                  </div>
                </div>
              <?php 
                }
              ?>
                <div class="row justify-content-center">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li class="page-item <?=$_GET['page']==1?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=share&page=1">第一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==1?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=share&page=<?($page-1)?>">前一頁</a>
                      </li>
                      <?php for($i=1;$i<=$max_page;$i++){ ?>
                        <li class="page-item <?= $_GET['page']==$i?'active':''?>">
                          <a class="page-link" href="../view/mypage.php?cate=share&page=<?=$i?>"><?=$i?></a>
                        </li>
                      <?php } ?>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=share&page=<?=($page+1)?>">下一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=share&page=<?=$max_page?>">最後一頁</a>
                      </li>
                    </ul>
                  </nav>
                </div>
              <?php
              }else{
              ?>
              <div class="row ml-2"><p>目前沒有留言</p></div>
              <?php  
              }
              ?>
          </div>
        <?php } ?>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='reservation'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">預約餐廳</h2>
          </div>
        <?php } ?>
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
<script>
  function confirmdelete(id) {
    var postinfo = id.split("delete_mylist");
    if (confirm('確認刪除？')) {
      $.ajax({
        url: "../contral/delete.php",
        type: "POST",
        data: {"mylist_rID": postinfo[1]},
          success: function(res) {
            confirm("已經成功刪除收藏");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消刪除');
    }
  };

  function setting_check(){
    var check_setting_user_name = $('#setting_user_name').val();
    var check_setting_nickname = $('#setting_nickname').val();
    var check_setting_email = $('#setting_email').val();

    if(check_setting_user_name==""){
      alert("請輸入會員名字進行修改");
      return false;
    }
    if(check_setting_nickname==""){
      alert("請輸入會員暱稱進行修改");
      return false;
    }
    if(check_setting_email==""){
      alert("請輸入email進行修改");
      return false;
    }
  }

  function delete_comment(id) {
    var postinfo = id.split("delete_comment");
    if (confirm('確認刪除留言？')) {
      $.ajax({
        url: "../contral/delete.php",
        type: "POST",
        data: {"admin_commentID": postinfo[1]},
          success: function(res) {
            confirm("已經成功刪除留言");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消刪除');
    }
  };
</script>