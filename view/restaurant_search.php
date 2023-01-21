<?php 
require_once('../DBPDO.php');
$area = $_GET['area'];
$category = $_GET['category'];
$price_range = $_GET['price_range'];
//判斷有選擇才進入sql進行搜尋
$where = [];
$whereSql = '';
// 搜尋條件顯示
$arr_search_word = [];
$search_word = ''; 
if(!empty($area)){
  $where[] = "`area` = '".$area."'"; 
  $arr_search_word[] = $area;
}
if(!empty($category)){
  $where[] = "`category` = '".$category."'"; 
  $arr_search_word[] = $category;
}
if(!empty($price_range)){
  $where[] = "(`price_lunch` = '".$price_range."' OR `price_dinner` = '".$price_range."')"; 
  $arr_search_word[] = $price_range;
}
if($where){
  $whereSql = implode('AND',$where);
}
if($arr_search_word){
  $search_word = implode('、', $arr_search_word);
}



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
            <h2 class="mb-3 text-white">搜尋結果</h2>
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
            <p>區域搜尋</p>
            <ul class="list-unstyled clearfix">
              <?php 
              $stmt=$dbpdo->prepare("SELECT * FROM `area_info`");
              $stmt->execute();
							$result_area = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($result_area as $k1=>$v1){
              ?>
                <li class="mb-2">
                  <input type="button" name="area_<?=$v1['aID']?>" id="area_<?=$v1['aID']?>" value="<?=$v1['area']?>">
                </li>
              <?php 
              } 
              ?>
            </ul>
          </div>
          <div class="feature-1">
            <p>分類搜尋</p>
            <ul class="list-unstyled clearfix">
              <?php 
              $stmt=$dbpdo->prepare("SELECT * FROM `categories_info`");
              $stmt->execute();
							$result_cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($result_cat as $k2=>$v2){
              ?>
                <li class="mb-2">
                  <input type="button" name="cat_<?=$v2['cID']?>" id="cat_<?=$v2['cID']?>" value="<?=$v2['cat_name']?>">
                </li>
              <?php 
              }
              ?>
            </ul>
          </div>
          <div class="feature-1">
            <p>價格搜尋</p>
            <ul class="list-unstyled clearfix">
              <?php 
              $stmt=$dbpdo->prepare("SELECT * FROM `price_range`");
              $stmt->execute();
              $result_price = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($result_price as $k3=>$v3){
              ?>
                <li class="mb-2">
                  <input type="button" name="price_<?=$v3['pID']?>" id="price_<?=$v3['pID']?>" value="<?=$v3['price_range']?>">
                </li>
              <?php 
              }
              ?>
            </ul>
          </div>
        </div>

          <div class="col-lg-9">
            <h3 class="section-title text-left mb-4"><?=$search_word?></h3>
            <?php
            $num = 4; //每頁呈現筆數 
            $sql = "SELECT * FROM `restaurant_info` WHERE $whereSql ORDER BY `id` DESC";
            $stmt = $dbpdo->prepare($sql);
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
            $sql1 = "SELECT * FROM `restaurant_info` WHERE $whereSql  ORDER BY `id` DESC LIMIT $start_no, $num";
            $stmt =  $dbpdo->prepare($sql1);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($total_restaurant>0){
              foreach($result as $k=>$v){
              ?>
                <div class="row ml-2">
                  <div class="col-3">
                    <a href="#"><img src="../images/person_1.jpg" alt="Image" class="img-fluid mb-4 rounded-20"></a>
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
                        <a class="c-hover" href="../view/restaurant_detail.php?rID=<?=$v['id']?>">詳細資訊</a>
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
                        <a class="page-link" href="http://localhost/pocheng/tokyo_restaurant/view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=1">第一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==1?'disabled':''?>">
                        <a class="page-link" href="http://localhost/pocheng/tokyo_restaurant/view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=<?($page-1)?>">前一頁</a>
                      </li>
                      <?php 
                      for($i=1;$i<=$max_page;$i++){ 
                        if ($i > $page - 4 && $i < $page + 4){ 
                      ?>
                          <li class="page-item <?= $_GET['page']==$i?'active':''?>">
                            <a class="page-link" href="http://localhost/pocheng/tokyo_restaurant/view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=<?=$i?>"><?=$i?></a>
                          </li>
                      <?php 
                        }
                      } 
                      ?>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="http://localhost/pocheng/tokyo_restaurant/view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=<?=($page+1)?>">下一頁</a>
                      </li>
                      <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                        <a class="page-link" href="http://localhost/pocheng/tokyo_restaurant/view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=<?=$max_page?>">最後一頁</a>
                      </li>
                    </ul>
                  </nav>
                </div>
              <?php
              }else{
              ?>
              <div class="row ml-2"><h4>目前沒有符合搜尋結果的資料</h4></div>
              <?php  
              }
              ?>
          </div>
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
<script>
  function toSignUpPage(){
    window.location.href='http://localhost/pocheng/tokyo_restaurant/view/signup.php';
  }

  function toForgetpasswordPage(){
    window.location.href='http://localhost/pocheng/tokyo_restaurant/view/forget_password.php';
  }

  function login_check(){
    var check_login_email = document.querySelector('#login_email');
    var check_login_password = document.querySelector('#login_password');
    if(check_login_email.value==""){
      alert("請輸入email進行登入");
      return false;
    }
    if(check_login_password.value==""){
      alert("請輸入密碼進行登入");
      return false;
    }
  }

  function signup_check(){
    var check_signup_user_name = document.querySelector('#signup_user_name');
    var check_signup_email = document.querySelector('#signup_email');
    var check_signup_password = document.querySelector('#signup_password');

    if(check_signup_user_name.value==""){
      alert("請輸入使用者名字進行註冊");
      return false;
    }
    if(check_signup_email.value==""){
      alert("請輸入email進行註冊");
      return false;
    }
    if(check_signup_password.value==""){
      alert("請輸入密碼進行註冊");
      return false;
    }
  }
</script>