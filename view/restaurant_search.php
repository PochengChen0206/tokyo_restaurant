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
            <form action="../contral/search.php" method="post" onsubmit="return search_check();">
              <div class="mb-3">
                <p>區域搜尋</p>
                <select name="area" id="area" class="form-control custom-select">
                  <option value="">選擇區域</option>
                  <?php 
                  $stmt=$dbpdo->prepare("SELECT * FROM `area_info`");
                  $stmt->execute();
                  $result_area = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result_area as $v1){
                  ?>
                    <option value="<?=$v1['area']?>" <?=$v1['area'] == $_GET['area'] ? "selected" : ""?>>
                      <?=$v1['area']?>
                    </option>
                  <?php 
                  } 
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <p>分類搜尋</p>
                <select name="category" id="category" class="form-control custom-select">
                  <option value="">請選擇分類</option>
                  <?php 
                  $stmt=$dbpdo->prepare("SELECT * FROM `categories_info`");
                  $stmt->execute();
                  $result_cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result_cat as $v2){
                  ?>
                    <option value="<?=$v2['cat_name']?>" <?=$v2['cat_name'] == $_GET['category'] ? "selected" : ""?>>
                      <?=$v2['cat_name']?>
                    </option>
                  <?php 
                  }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <p>價格區間搜尋</p>
                <select name="price_range" id="price_range" class="form-control custom-select">
                  <option value="">請選擇價格區間</option>
                  <?php 
                  $stmt=$dbpdo->prepare("SELECT * FROM `price_range`");
                  $stmt->execute();
                  $result_price = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result_price as $v3){
                  ?>
                    <option value="<?=$v3['price_range']?>" <?=$v3['price_range'] == $_GET['price_range'] ? "selected" : ""?>>
                      <?=$v3['price_range']?>
                    </option>
                  <?php 
                  }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <input type="submit" class="btn btn-primary btn-block" value="Search">
              </div>
            </form>
          </div>
        </div>

        <div class="col-lg-9">
          <h3 class="section-title text-left mb-4">
            <?php
              if($_GET['area']!='all' && $_GET['category']!='all' && $_GET['price_range']!='all'){
                echo $search_word;
              }else{
                echo '所有餐廳';
              }
            ?>
          </h3>
          <?php
          $num = 4; //每頁呈現筆數 
          if($_GET['area']!='all' && $_GET['category']!='all' && $_GET['price_range']!='all'){
            $sql = "SELECT * FROM `restaurant_info` WHERE $whereSql ORDER BY `id` DESC";
            $stmt = $dbpdo->prepare($sql);
          }else{
            $sql_all =  "SELECT * FROM `restaurant_info` ORDER BY `id` DESC";
            $stmt = $dbpdo->prepare($sql_all);
          }

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
          if($_GET['area']!='all' && $_GET['category']!='all' && $_GET['price_range']!='all'){
            $sql1 = "SELECT * FROM `restaurant_info` WHERE $whereSql  ORDER BY `id` DESC LIMIT $start_no, $num";
            $stmt =  $dbpdo->prepare($sql1);
          }else{
            $sql1_all = "SELECT * FROM `restaurant_info` ORDER BY `id` DESC LIMIT $start_no, $num";
            $stmt =  $dbpdo->prepare($sql1_all);
          }
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if($total_restaurant>0){
            foreach($result as $k=>$v){
              if($v['index_image']!=""){
                $img = $v['index_image'];
              }else{
                $img = "../images/image_prepare.jpg";
              }
            ?>
              <div class="row ml-2">
                <div class="col-3">
                  <a href="../view/restaurant_detail.php?rID=<?=$v['id']?>"><img src="<?=$img?>" alt="Image" class="img-fluid mb-4 rounded-20"></a>
                </div>
                <div class="col-9">
                  <h4><a href="../view/restaurant_detail.php?rID=<?=$v['id']?>"><?=$v['name']?></a></h4>
                  <div>
                    <ul class="list-unstyled two-col clearfix">
                      <li>區域：<?=$v['area']?></li>
                      <li>地點：<?=$v['location']?></li>
                      <li>分類：<?=$v['category']?></li>
                      <li>時間：<?=date("Y/m/d",strtotime($v['creat_date']))?></li>
                      <li>午餐價格：<?=$v['price_lunch']?></li>
                      <li>晚餐價格：<?=$v['price_dinner']?></li>
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
                      <a class="page-link" href="../view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=1">第一頁</a>
                    </li>
                    <li class="page-item <?=$_GET['page']==1?'disabled':''?>">
                      <a class="page-link" href="../view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=<?($page-1)?>">前一頁</a>
                    </li>
                    <?php 
                    for($i=1;$i<=$max_page;$i++){ 
                      if ($i > $page - 4 && $i < $page + 4){ 
                    ?>
                        <li class="page-item <?= $_GET['page']==$i?'active':''?>">
                          <a class="page-link" href="../view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=<?=$i?>"><?=$i?></a>
                        </li>
                    <?php 
                      }
                    } 
                    ?>
                    <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                      <a class="page-link" href="../view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=<?=($page+1)?>">下一頁</a>
                    </li>
                    <li class="page-item <?=$_GET['page']==$max_page?'disabled':''?>">
                      <a class="page-link" href="../view/restaurant_search.php?area=<?=$area?>&category=<?=$category?>&price_range=<?=$price_range?>&page=<?=$max_page?>">最後一頁</a>
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
      </div>
    </div>
  </div>

  <?php require_once('../view/footer.php'); ?>
  <?php require_once('../view/src_js.php'); ?>
</body>
</html>
<script>
  function search_check()
  {
	  var check_area =$('#area').val();
    var check_category = $('#category').val();
    var check_price_range = $('#price_range').val();  
    if(check_area=="" && check_category=="" && check_price_range==""){
      alert("請輸入搜尋條件");
      return false;
    }
	}
</script>