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
      <div class="row justify-content-between align-items-start">
        <div class="col-lg-3">
          <div class="feature-1">
            <ul class="list-unstyled clearfix">
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="../view/admin.php?cate=edit&page=1">餐廳管理</a></li>
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="../view/admin.php?cate=new">餐廳新增</a></li>
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="../view/admin.php?cate=member&page=1">會員管理</a></li>
              <li class="mb-3"><a class="col-9 btn btn-outline-dark" href="../view/admin.php?cate=report&page=1">分享心得管理</a></li>
            </ul>
          </div>
        </div>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='edit'){ ?>
          <div class="col-lg-9">
          <h3 class="section-title text-left mb-4">餐廳管理</h3>
          <?php
          $num = 4; //每頁呈現筆數 
          $sql_all =  "SELECT * FROM `restaurant_info` ORDER BY `id` DESC";
          $stmt = $dbpdo->prepare($sql_all);

          $stmt->execute();
          $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $total_restaurant = count($row);
          $max_page = ceil($total_restaurant/$num);
          
          if(isset($_GET['page']) && $_GET['page'] > 0){
            $page = $_GET['page'];
          }else{
            $page = 1;
          }

          $start_no = ($page - 1) * $num;
          $sql1_all = "SELECT * FROM `restaurant_info` ORDER BY `id` DESC LIMIT $start_no, $num";
          $stmt =  $dbpdo->prepare($sql1_all);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if($total_restaurant>0){
            foreach($result as $k=>$v){
              if($v['index_image']!=""){
                $img = '.'.$v['index_image'];
              }else{
                $img = "../images/image_prepare.jpg";
              }
            ?>
              <div class="row ml-2">
                <div class="col-3">
                  <a href="../view/restaurant_detail.php?rID=<?=$v['id']?>&page=1"><img src="<?=$img?>" alt="Image" class="img-fluid mb-4 rounded-20"></a>
                </div>
                <div class="col-9">
                  <h4><?=$v['name']?></h4>
                  <div>
                    <ul class="list-unstyled two-col clearfix">
                      <li>區域：<?=$v['area']?></li>
                      <li>地點：<?=$v['location']?></li>
                      <li>分類：<?=$v['category']?></li>
                      <li>時間：<?=date("Y/m/d",strtotime($v['creat_date']))?></li>
                    </ul>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <a class="c-hover" href="../view/restaurant_detail_edit.php?rID=<?=$v['id']?>">查看和修改</a>
                    </div>
                    <div class="col-6">
                      <input type="button" id="delete_restaurant<?=$v['id']?>" onclick="delete_restaurant(this.id);" name="delete_restaurant" value="刪除餐廳">
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
                      <a class="page-link" href="../view/admin.php?cate=edit&page=1">第一頁</a>
                    </li>
                    <li class="page-item <?=$_GET['page']==1?'disabled':''?>">
                      <a class="page-link" href="../view/admin.php?cate=edit&page=<?($page-1)?>">前一頁</a>
                    </li>
                    <?php 
                    for($i=1;$i<=$max_page;$i++){ 
                      if ($i > $page - 4 && $i < $page + 4){ 
                    ?>
                      <li class="page-item <?= $_GET['page']==$i?'active':''?>">
                        <a class="page-link" href="../view/admin.php?cate=edit&page=<?=$i?>"><?=$i?></a>
                      </li>
                    <?php 
                      }
                    } 
                    ?>
                    <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                      <a class="page-link" href="../view/admin.php?cate=edit&page=<?=($page+1)?>">下一頁</a>
                    </li>
                    <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                      <a class="page-link" href="../view/admin.php?cate=edit&page=<?=$max_page?>">最後一頁</a>
                    </li>
                  </ul>
                </nav>
              </div>
            <?php
            }else{
            ?>
              <div class="row ml-2"><h4>目前沒有符合搜尋條件的資料</h4></div>
            <?php  
            }
            ?>
          </div>
        <?php } ?>        

        <?php if(isset($_GET['cate']) && $_GET['cate']=='new'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">餐廳新增</h2>
              <form class="contact-form" data-aos="fade-up" data-aos-delay="200" action="../contral/insert_into.php" method="post" onsubmit="return insert_check();">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">餐廳名稱</label>
                      <input class="form-control" type="text" id="name" name="name" placeholder="請輸入餐廳名稱" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">區域</label>
                      <select name="area" id="area" class="form-control custom-select">
                        <option value="">請選擇區域</option>
                      <?php 
                      $stmt=$dbpdo->prepare("SELECT * FROM `area_info`");
                      $stmt->execute();
                      $result_area = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      foreach($result_area as $k=>$v){
                      ?>
                        <option value="<?=$v['area']?>"><?=$v['area']?></option>
                      <?php 
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">地點</label>
                      <input class="form-control" type="text" id="location" name="location" placeholder="請輸入餐廳地點" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">分類</label>
                      <select name="category" id="category" class="form-control custom-select">
                        <option value="">請選擇分類</option>
                      <?php 
                      $stmt=$dbpdo->prepare("SELECT * FROM `categories_info`");
                      $stmt->execute();
                      $result_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      foreach($result_categories as $k=>$v){
                      ?>
                        <option value="<?=$v['cat_name']?>"><?=$v['cat_name']?></option>
                      <?php 
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">開始營業時間</label>
                      <input class="form-control" type="text" id="open_time" name="open_time" placeholder="請選擇開始營業時間" onblur="check_open_time();">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">結束營業時間</label>
                      <input class="form-control" type="text" id="close_time" name="close_time" placeholder="請選擇結束營業時間" onblur="check_close_time();">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">午餐預算</label>
                      <select name="price_lunch" id="price_lunch" class="form-control custom-select">
                        <option value="">請選擇價格區間</option>
                      <?php 
                      $stmt=$dbpdo->prepare("SELECT * FROM `price_range`");
                      $stmt->execute();
                      $result_price_range = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      foreach($result_price_range as $k=>$v){
                      ?>
                        <option value="<?=$v['price_range']?>"><?=$v['price_range']?></option>
                      <?php 
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">晚餐預算</label>
                      <select name="price_dinner" id="price_dinner" class="form-control custom-select">
                        <option value="">請選擇價格區間</option>
                      <?php 
                      $stmt=$dbpdo->prepare("SELECT * FROM `price_range`");
                      $stmt->execute();
                      $result_price_range = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      foreach($result_price_range as $k=>$v){
                      ?>
                        <option value="<?=$v['price_range']?>"><?=$v['price_range']?></option>
                      <?php 
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">交通</label>
                      <input class="form-control" type="text" id="access" name="access" placeholder="請輸入交通資訊">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black">餐廳網站</label>
                      <input class="form-control" type="text" name="link" id="link" placeholder="請輸入餐廳網站">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="text-black">備註</label>
                  <textarea class="form-control" name="memo" id="memo" rows="5"></textarea>
                </div>
                <div class="row justify-content-center">
                  <input type="hidden" id="formID" name="formID" value="creat_list">
                  <button type="submit" class="col-3 btn btn-primary mt-2">新增餐廳</button>
                </div>
              </form>
          </div>
        <?php } ?>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='member'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">會員管理</h2>
            <?php
            $num = 5; //每頁呈現筆數 
            $stmt = $dbpdo->prepare("SELECT `userID` FROM `user_info`");
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
            $sql = "SELECT * FROM `user_info` ORDER BY `userID` DESC LIMIT $start_no, $num";
            $stmt =  $dbpdo->prepare($sql);
            $stmt->execute();
            $result_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($total_list>0){
              $img = "";
              foreach($result_list as $k=>$v){
                if($v['user_image']!=""){
                  $img = $v['user_image'];
                }else{
                  $img = "../images/image_prepare.jpg";
                }
              ?>
                <div class="row ml-2">
                  <div class="col-3">
                    <div style="width: 150px;height:150px; border-radius: 20px; position: relative; overflow: hidden;">
                      <img src="<?=$img?>" alt="Image" class="mb-4" style="position: absolute; width: 100%; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    </div>  
                  </div>
                  <div class="col-9">
                    <h4><?=$v['user_name']?></h4>
                    <div>
                      <ul class="list-unstyled two-col clearfix">
                        <li>暱稱：<?=$v['nickname']?></li>
                        <li>email：<?=$v['email']?></li>
                        <li>權限：<?=$v['user_level']?></li>
                        <li>建立時間：<?=$v['created_date']?></li>
                      </ul>
                    </div>
                    <div class="row justify-content-end">
                      <div>
                        <input type="button" id="delete_user<?=$v['userID']?>" onclick="delete_user(this.id);" name="delete_user" value="刪除使用者">
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
                        <a class="page-link" href="../view/mypage.php?cate=member&page=1">第一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==1?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=member&page=<?($page-1)?>">前一頁</a>
                      </li>
                      <?php for($i=1;$i<=$max_page;$i++){ ?>
                        <li class="page-item <?= $_GET['page']==$i?'active':''?>">
                          <a class="page-link" href="../view/mypage.php?cate=member&page=<?=$i?>"><?=$i?></a>
                        </li>
                      <?php } ?>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=member&page=<?=($page+1)?>">下一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="../view/mypage.php?cate=member&page=<?=$max_page?>">最後一頁</a>
                      </li>
                    </ul>
                  </nav>
                </div>
              <?php
              }else{
              ?>
              <div class="row ml-2"><p>目前沒有會員</p></div>
              <?php  
              }
              ?>
          </div>
        <?php } ?>

        <?php if(isset($_GET['cate']) && $_GET['cate']=='report'){ ?>
          <div class="col-lg-9">
            <h2 class="section-title text-left mb-4">分享心得管理</h2>
            <?php
            $num = 5; //每頁呈現筆數 
            $stmt = $dbpdo->prepare("SELECT `id` FROM `comment_info`");
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
            $sql = "SELECT a.*, b.`user_image`, c.`name` FROM `comment_info` a INNER JOIN `user_info` b ON a.`userID` = b.`userID` INNER JOIN `restaurant_info` c ON a.`rID` = c.`id` ORDER BY a.`creat_date` DESC LIMIT $start_no, $num";
            $stmt =  $dbpdo->prepare($sql);
            $stmt->execute();
            $result_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($total_list>0){
              $img = "";
              foreach($result_list as $k=>$v){
                if($v['user_image']!=""){
                  $img = $v['user_image'];
                }else{
                  $img = "../images/image_prepare.jpg";
                }
              ?>
                <div class="row ml-2">
                  <div class="col-3">
                    <div class="mb-4" style="width: 150px;height:150px; border-radius: 20px; position: relative; overflow: hidden;">
                      <img src="<?=$img?>" alt="Image" style="position: absolute; width: 100%; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    </div>  
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
                        <a class="page-link" href="../view/admin.php?cate=report&page=1">第一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==1?'disabled':''?>">
                        <a class="page-link" href="../view/admin.php?cate=report&page=<?($page-1)?>">前一頁</a>
                      </li>
                      <?php for($i=1;$i<=$max_page;$i++){ ?>
                        <li class="page-item <?= $_GET['page']==$i?'active':''?>">
                          <a class="page-link" href="../view/admin.php?cate=report&page=<?=$i?>"><?=$i?></a>
                        </li>
                      <?php } ?>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="../view/admin.php?cate=report&page=<?=($page+1)?>">下一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="../view/admin.php?cate=report&page=<?=$max_page?>">最後一頁</a>
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
  <script src="../js/jquery.datetimepicker.full.min.js"></script>
</body>
</html>
<script>
  $('#open_time').datetimepicker({
    datepicker:false,
    format:'H:i'
  });

  $('#close_time').datetimepicker({
    datepicker:false,
    format:'H:i'
  });

  function check_open_time(){
    var open_time = $('#open_time').val();
    
    var check_open_time = open_time.match(/^([0-2][0-9]):([0-5][0-9])$/);    
    if(check_open_time == null){
      alert('輸入的時間格式不對'); 
      return false;
    }    
    if(check_open_time[1]>23 || check_open_time[2]>59){    
      alert("輸入的時間格式不對");    
      return false    
    }
  }

  function check_close_time(){
    var close_time = $('#close_time').val();

    var check_close_time = close_time.match(/^([0-2][0-9]):([0-5][0-9])$/);    
    if(check_close_time == null){
      alert('輸入的時間格式不對'); 
      return false;
    }    
    if(check_close_time[1]>23 || check_close_time[2]>59){    
      alert("輸入的時間格式不對");    
      return false    
    }
  }

  function insert_check(){
    var name = $('#name').val();
    var area = $('#area').val();
    var location = $('#location').val();
    var category = $('#category').val();
    var access = $('#access').val();

    if(name==""){
      alert("請輸入餐廳名稱");
      return false;
    }

    if(area==""){
      alert("請選擇區域");
      return false;
    }

    if(location==""){
      alert("請輸入地點");
      return false;
    }

    if(category==""){
      alert("請選擇分類");
      return false;
    }

    if(access==""){
      alert("請輸入交通資訊");
      return false;
    }
  }

  function delete_restaurant(id) {
    var postinfo = id.split("delete_restaurant");
    if (confirm('確認刪除餐廳？')) {
      $.ajax({
        url: "../contral/delete.php",
        type: "POST",
        data: {"admin_rID": postinfo[1]},
          success: function(res) {
            confirm("已經成功刪除餐廳");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消刪除');
    }
  };

  function delete_user(id) {
    var postinfo = id.split("delete_user");
    if (confirm('確認刪除使用者？')) {
      $.ajax({
        url: "../contral/delete.php",
        type: "POST",
        data: {"admin_userID": postinfo[1]},
          success: function(res) {
            confirm("已經成功刪除使用者");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消刪除');
    }
  };

  function delete_comment(id) {
    var postinfo = id.split("delete_comment");
    if (confirm('確認刪除心得？')) {
      $.ajax({
        url: "../contral/delete.php",
        type: "POST",
        data: {"admin_commentID": postinfo[1]},
          success: function(res) {
            confirm("已經成功刪除心得");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消刪除');
    }
  };
</script>


