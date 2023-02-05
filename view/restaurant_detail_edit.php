<?php require_once('../DBPDO.php'); ?>
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
            <h2 class="mb-3 text-white">餐廳資訊</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  $rID=$_GET['rID'];
  $stmt=$dbpdo->prepare("SELECT * FROM `restaurant_info` WHERE `id` = :rID");
  $stmt->bindParam(':rID',$rID,PDO::PARAM_STR);
  $stmt->execute();
  $result_detail = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result_detail as $k=>$v){
    $name = $v['name'];
    $memo = nl2br($v['memo']);
    $area = $v['area'];
    $location = $v['location'];
    $category = $v['category'];
    $access = $v['access'];
    $open_time = $v['open_time'];
    $close_time = $v['close_time'];
    $price_lunch = $v['price_lunch'];
    $price_dinner = $v['price_dinner'];
    $link = ($v['link']!=""?$v['link']:"暫無<br>網站");
  ?>
    <div class="untree_co-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="owl-single dots-absolute owl-carousel">
              <?php if($v['image1']!=""){ ?>
                <img src="<?=$v['image1']?>" alt="Free HTML Template by Untree.co" class="img-fluid rounded-20">
              <?php }else{ ?>
                <div class="col-8">
                  <img src="../images/image_prepare.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-20">
                </div>
              <?php } ?>
              <?php if($v['image2']!=""){ ?>
                <img src="<?=$v['image2']?>" alt="Free HTML Template by Untree.co" class="img-fluid rounded-20">
              <?php }?>
              <?php if($v['image3']!=""){ ?>
                <img src="<?=$v['image3']?>" alt="Free HTML Template by Untree.co" class="img-fluid rounded-20">
              <?php }?>
            </div>
          </div>
          <div class="col-lg-6 pl-lg-6 ml-auto">
            <form class="contact-form" data-aos="fade-up" data-aos-delay="200" action="../contral/update_restaurant_detail.php" method="post" onsubmit="return update_check();">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label class="text-black">餐廳名稱</label>
                    <input class="form-control" type="text" id="name" name="name" value="<?=$name?>" required>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="text-black">區域</label>
                    <select name="area" id="area" class="form-control custom-select">
                      <option value="<?=$area?>"><?=$area?></option>
                    <?php 
                    $stmt=$dbpdo->prepare("SELECT * FROM `area_info`");
                    $stmt->execute();
                    $result_area = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result_area as $k=>$v){
                      if($v['area']==$area){continue;}
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
                    <input class="form-control" type="text" id="location" name="location" value="<?=$location?>" required>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="text-black">分類</label>
                    <select name="category" id="category" class="form-control custom-select">
                      <option value="<?=$category?>"><?=$category?></option>
                    <?php 
                    $stmt=$dbpdo->prepare("SELECT * FROM `categories_info`");
                    $stmt->execute();
                    $result_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result_categories as $k=>$v){
                      if($v['cat_name']==$category){continue;}
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
                    <input class="form-control" type="text" id="open_time" name="open_time" value="<?=$open_time?>" onblur="check_open_time();">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="text-black">結束營業時間</label>
                    <input class="form-control" type="text" id="close_time" name="close_time" value="<?=$close_time?>" onblur="check_close_time();">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label class="text-black">午餐預算</label>
                    <select name="price_lunch" id="price_lunch" class="form-control custom-select">
                      <option value="<?=$price_lunch?>"><?=$price_lunch?></option>
                    <?php 
                    $stmt=$dbpdo->prepare("SELECT * FROM `price_range`");
                    $stmt->execute();
                    $result_price_range = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result_price_range as $k=>$v){
                      if($v['price_range']==$price_lunch){ continue;}
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
                      <option value="<?=$price_dinner?>"><?=$price_dinner?></option>
                    <?php 
                    $stmt=$dbpdo->prepare("SELECT * FROM `price_range`");
                    $stmt->execute();
                    $result_price_range = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result_price_range as $k=>$v){
                      if($v['price_range']==$price_dinner){ continue;}
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
                    <input class="form-control" type="text" id="access" name="access" value="<?=$access?>">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="text-black">餐廳網站</label>
                    <input class="form-control" type="text" name="link" id="link" value="<?=$link?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="text-black">備註</label>
                <textarea class="form-control" name="memo" id="memo" rows="5"><?=$memo?></textarea>
              </div>
              <div class="row justify-content-center">
                <input type="hidden" id="rID" name="rID" value="<?=$rID?>">
                <button type="submit" class="col-4 btn btn-primary mt-2">修改餐廳資訊</button>
              </div>
              <div class="row justify-content-center">
                <a class="col-4 btn btn-primary mt-2" href="../view/admin.php?cate=edit&page=1">返回餐廳管理</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  

<?php require_once('../view/footer.php'); ?>
<?php require_once('../view/src_js.php'); ?>
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

  function check_open_time()
  {
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

  function check_close_time()
  {
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

  function update_check()
  {
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
</script>