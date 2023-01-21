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
  ?>
    <div class="untree_co-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="owl-single dots-absolute owl-carousel">
              <!-- 判斷有幾張圖片顯示 -->
              <img src="../images/slider-1.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-20">
              <img src="../images/slider-2.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-20">
              <img src="../images/slider-3.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-20">
              <img src="../images/slider-4.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-20">
              <img src="../images/slider-5.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-20">
            </div>
          </div>
          <div class="col-lg-6 pl-lg-6 ml-auto">
            <h2 class="section-title mb-4"><?=$v['name']?></h2>
            <p><?=nl2br($v['memo'])?></p>
            <ul class="list-unstyled two-col clearfix">
              <li>地區：<?=$v['area']?></li>
              <li>地點：<?=$v['location']?></li>
              <li>分類：<?=$v['category']?></li>
              <li>交通：<?=$v['access']?></li>
              <li>開始營業時間：<?=$v['open_time']?><br>結束營業時間：<?=$v['close_time']?></li>
              <li>午餐預算：<?=$v['price_lunch']?><br>晚餐預算：<?=$v['price_dinner']?></li>
              <li>餐廳網站：
                <?php 
                  if($v['link']!=""){ 
                ?>
                  <a href="<?=$v['link']?>" target="_blank">查看</a>
                <?php 
                  }else{
                    echo "暫無<br>網站";
                  }
                ?>
              </li>
            </ul>
            <div class="row justify-content-end">
              <?php
                $row_check=$dbpdo->prepare("SELECT `rID` FROM `my_restaurant_list` WHERE `rID` = :rID");
                $row_check->bindParam(':rID',$rID,PDO::PARAM_STR);
                $row_check->execute();
                //取得my_restaurant_list裡面的rID判斷是否已經存在
                $check_rID = $row_check->fetch(PDO::FETCH_ASSOC);
                if(isset($check_rID['rID'])){
              ?>
                  <input type="button" class="btn btn-primary" id="check_mylist" name="check_mylist" value="已收藏">
              <?php }else{ ?>
                  <input type="button" class="btn btn-primary" id="add_mylist_<?=$v['id']?>" name="add_mylist" value="加入我的收藏" onclick="addto_mylist(this.id);">
              <?php } ?>
                <!-- 下方ajax post用的變數 -->
                <input type="hidden" id="rID" name="rID" value="<?=$v['id']?>">
                <input type="hidden" id="name" name="name" value="<?=$v['name']?>">
                <input type="hidden" id="area" name="area" value="<?=$v['area']?>">
                <input type="hidden" id="location" name="location" value="<?=$v['location']?>">
                <input type="hidden" id="category" name="category" value="<?=$v['category']?>">
                <input type="hidden" id="open_time" name="open_time" value="<?=$v['open_time']?>">
                <input type="hidden" id="close_time" name="close_time" value="<?=$v['close_time']?>">
                <input type="hidden" id="access" name="access" value="<?=$v['access']?>">
                <input type="hidden" id="price_lunch" name="price_lunch" value="<?=$v['price_lunch']?>">
                <input type="hidden" id="price_dinner" name="price_dinner" value="<?=$v['price_dinner']?>">
                <input type="hidden" id="link" name="link" value="<?=$v['link']?>">
                <input type="hidden" id="memo" name="memo" value="<?=$v['memo']?>">
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <div class="untree_co-section">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-6">
          <figure class="img-play-video">
            <a id="play-video" class="video-play-button" href="https://www.youtube.com/watch?v=mwtbEGNABWU" data-fancybox>
              <span></span>
            </a>
            <img src="images/hero-slider-2.jpg" alt="Image" class="img-fluid rounded-20">
          </figure>
        </div>

        <div class="col-lg-5">
          <h2 class="section-title text-left mb-4">Take a look at Tour Video</h2>
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
          <p><a href="#" class="btn btn-primary">Get Started</a></p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="py-5 cta-section">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
          <h2 class="mb-2 text-white">加入討論</h2>
          <p class="mb-4 lead text-white text-white-opacity">去過這家餐廳了嗎?或是對於這家餐廳有什麼想法?</p>
          <p class="mb-0">
            <a href="booking.html" class="btn btn-outline-white text-white btn-md font-weight-bold">登入會員分享心得</a>
          </p>
          <!-- 加上判斷是否已經登入會員顯示 -->
          <!-- 這邊的登入要加上可以判斷回到頁面的value，可以用php記住當前頁面存到session -->
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
  function addto_mylist(id) {
    let rID = $('#rID').val();
    let name = $('#name').val();
    let area = $('#area').val();
    let location = $('#location').val();
    let category = $('#category').val();
    let open_time = $('#open_time').val();
    let close_time = $('#close_time').val();
    let access = $('#access').val();
    let memo = $('#memo').val();
    let price_lunch = $('#price_lunch').val();
    let price_dinner = $('#price_dinner').val();
    let link = $('#link').val();

    if (confirm('確認加入我的收藏？')) {
      $.ajax({
        url: "../contral/insert_into.php",
        type: "POST",
        data: {
              "formID": "add_mylist",
              "rID": rID,
              "name": name,
              "area": area,
              "location": location,
              "category": category,
              "open_time": open_time,
              "close_time": close_time,
              "access": access,
              "memo": memo, //memo不能直接存$v['memo']不然會報錯
              "price_lunch": price_lunch,
              "price_dinner": price_dinner,
              "link": link
              },
          success: function(res) {
            confirm("已經成功加入我的收藏");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消加入我的收藏');
    }
  };
</script>