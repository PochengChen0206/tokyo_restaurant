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
                  <a class="c-hover" href="<?=$v['link']?>" target="_blank">查看</a>
                <?php 
                  }else{
                    echo "暫無<br>網站";
                  }
                ?>
              </li>
            </ul>
            <div class="row justify-content-end mr-3">
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
      <div class="col-lg-12" style="border-top: 1px solid #d5d5d8; border-bottom: 1px solid #d5d5d8;">
        <h2 class="section-title text-left mt-3 mb-4">用餐心得</h2>
        <?php
        $sql = "SELECT *  FROM `comment_info` a INNER JOIN `user_info` b ON a.`user_id` = b.`userID` WHERE a.`rID` = '".$rID."' ORDER BY a.`creat_date`";
        $stmt =  $dbpdo->prepare($sql);
        $stmt->execute();
        $result_comment = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_comment = count($result_comment);
        if($total_comment>0){
          $img = "";
          foreach($result_comment as $k=>$v){
            $comment_id = $v['id'];
          ?>
            <div class="row ml-2 mb-3">
              <?php if(!isset($_GET['editid'])){ ?>
                <div class="col-1">
                  <?php if($v['user_image']!=""){ ?>
                    <img src="../images/detail/A1301_index.jpg" alt="Image" class="img-fluid mb-4 rounded-20">
                  <?php }else{ ?>
                    <img src="../images/image_prepare.jpg" alt="Image" class="img-fluid mb-4 rounded-20">
                  <?php } ?>
                </div>
                <div class="col-11" style="background-color: #f4f4f5;">
                  <div><h5><?=$v['nickname']?></h5></div>
                  <div><?=nl2br($v['content'])?></div>
                  <div><?=$v['creat_date']?></div>
                  <div class="row justify-content-end mr-2 mb-2">
                    <div class="mr-3">
                      <input type="button" id="edit_comment<?=$comment_id?>" onclick="editcomment(this.id);" name="edit_comment" value="編輯">
                    </div>
                    <div>
                      <input type="button" id="delete_comment<?=$comment_id?>" onclick="confirmdelete(this.id);" name="delete_comment" value="刪除">
                    </div>
                  </div>
                </div>
              <?php }elseif($_GET['editid']==$comment_id){ ?>
                <div class="col-1">
                  <?php if($v['user_image']!=""){ ?>
                    <img src="../images/detail/A1301_index.jpg" alt="Image" class="img-fluid mb-4 rounded-20">
                  <?php }else{ ?>
                    <img src="../images/image_prepare.jpg" alt="Image" class="img-fluid mb-4 rounded-20">
                  <?php } ?>
                </div>
                <div class="col-11" style="background-color: #f4f4f5;">
                  <div><h5><?=$v['nickname']?></h5></div>
                  <form action="../contral/update_comment.php" method="post">
                    <div><input type="text" id="edit_content" name="edit_content" value="<?=nl2br($v['content'])?>"></div>
                    <div><?=$v['creat_date']?></div>
                    <div class="row justify-content-end mr-2 mb-2">
                    <div class="mr-3">
                      <input type="hidden" name="comment_rID" value="<?=$rID?>">
                      <input type="hidden" name="comment_id" value="<?=$comment_id?>">
                      <input type="submit" value="編輯留言">
                    </div>
                    <div>
                      <input type="button" onclick="goback_comment();" value="返回用餐心得">
                    </div>
                  </form>
                </div>
              <?php } ?>   
            </div>
          <?php } ?>
        <?php
        }else{
        ?>
        <div class="row ml-2"><p>目前尚未有心得分享</p></div>
        <?php  
        }
        ?>
      </div>
      <?php if(!isset($_GET['editid'])){ ?>
        <div class="col-lg-12 mt-3">
          <form action="../contral/insert_into.php" method="post" onsubmit="return content_check();">
          <div class="row ml-2">
            <div class="col-1">
              <a href="#">
                <img src="../images/detail/yoroniku_index.jpg" alt="Image" class="img-fluid mb-4 rounded-20">
              </a>
            </div>
            <div class="col-10">
              <textarea name="content" id="content" cols="100" rows="5"></textarea>
              <input type="hidden" name="comment_rID" value="<?=$rID?>">
              <input type="hidden" name="user_id" value="11">
              <input type="hidden" name="nickname" value="jay">
              <input type="hidden" name="formID" value="comment">
            </div>
            <div class="col-1 row align-items-end">
              <input type="submit" class="btn btn-primary" value="留言">
            </div>
          </div>
          </form>
        </div>
      <?php } ?>
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
    var rID = $('#rID').val();
    var name = $('#name').val();
    var area = $('#area').val();
    var location = $('#location').val();
    var category = $('#category').val();
    var open_time = $('#open_time').val();
    var close_time = $('#close_time').val();
    var access = $('#access').val();
    var memo = $('#memo').val();
    var price_lunch = $('#price_lunch').val();
    var price_dinner = $('#price_dinner').val();
    var link = $('#link').val();

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
            confirm("成功加入我的收藏");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消加入我的收藏');
    }
  };

  function content_check(){
		var check_content =$('#content').val();
    if(check_content==""){
      alert("請輸入留言內容");
      return false;
    }
	}

  function confirmdelete(id) {
    var postinfo = id.split("delete_comment");
    if (confirm('確認刪除？')) {
      $.ajax({
        url: "../contral/delete.php",
        type: "POST",
        data: {"comment_id": postinfo[1]},
          success: function(res) {
            confirm("成功刪除留言");
            document.location.reload(true);
          }
      });
    } else {
      alert('已取消刪除');
    }
  };

  function editcomment(id) {
    var editid = id.split("edit_comment");
    window.location.href="../view/restaurant_detail.php?rID=<?=$rID?>&page=1&editid=" + editid[1];
  }

  function goback_comment(){
    window.location.href="../view/restaurant_detail.php?rID=<?=$rID?>&page=1";
  }
</script>