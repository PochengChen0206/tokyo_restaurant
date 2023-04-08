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
  $rID = $_GET['rID'];
  $stmt = $dbpdo->prepare("SELECT * FROM `restaurant_info` WHERE `id` = :rID");
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
            <?php if(isset($_SESSION['userID'])){ ?>
              <div class="row justify-content-end mr-3">
                <?php
                  $userID = $_SESSION['userID'];
                  $stmt=$dbpdo->prepare("SELECT `rID` FROM `my_restaurant_list` WHERE `userID` = :userID");
                  $stmt->bindParam(':userID',$userID,PDO::PARAM_STR);
                  $stmt->execute();
                  //取得my_restaurant_list裡面的rID判斷是否已經存在
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result as $r1){
                    $check_rID = $r1['rID'];
                  } 
                  if(isset($check_rID)){
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
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <?php include('../view/restaurant_detail_comments.php'); ?>
  
  <div class="py-5 cta-section">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
          <h2 class="mb-2 text-white">加入討論</h2>
          <p class="mb-4 lead text-white text-white-opacity">去過這家餐廳了嗎?或是對於這家餐廳有什麼想法?</p>
          <p class="mb-0">
            <a href="../view/login.php" class="btn btn-outline-white text-white btn-md font-weight-bold">登入會員分享心得</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  

<?php require_once('../view/footer.php'); ?>
<?php require_once('../view/src_js.php'); ?>
</body>
</html>
<script>
  function addto_mylist(id)
  {
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
              "memo": memo,
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

  function content_check()
  {
		var check_content =$('#content').val();
    if(check_content==""){
      alert("請輸入留言內容");
      return false;
    }
	}

  function confirmdelete(id)
  {
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

  function editcomment(id)
  {
    var editid = id.split("edit_comment");
    window.location.href="../view/restaurant_detail.php?rID=<?=$rID?>&editid=" + editid[1];
  }

  function goback_comment()
  {
    window.location.href="../view/restaurant_detail.php?rID=<?=$rID?>";
  }

  function check_like(id)
  {
    var rID = '<?=$rID?>';
    var like_id = id; //更改like狀態用
    var cID = id.split("_"); //DB判斷用
    var sum_like_now = $("#sum_like_"+cID[1]).text(); //取得當下的like數
    var sum_like_minus = "";
    if(sum_like_now == "" || sum_like_now == '0'){
      sum_like_now = parseInt(0);
      sum_like_minus = "0";
    }else{
      sum_like_now = parseInt($("#sum_like_"+cID[1]).text());
      sum_like_minus = (sum_like_now - 1);
    }
    var sum_like_plus = (sum_like_now + 1);
    $.ajax({
      url: "../contral/like_setting.php",
      type: "POST",
      data: { 
        "rID": rID,
        "cID": cID[1],
        "sum_like": sum_like_now
      },
        success: function(res) {
          if(res == "liked"){
            $("#like_"+cID[1]+" div").html("<i class='fa-solid fa-heart'></i>");
            $("#sum_like_"+cID[1]).text(sum_like_plus);
          }else if(res == "unlike"){
            $("#like_"+cID[1]+" div").html("<i class='fa-regular fa-heart'></i>");
            if(sum_like_minus != "0"){
              $("#sum_like_"+cID[1]).text(sum_like_minus);
            }else{
              $("#sum_like_"+cID[1]).text("");
            }
          }else if(res == "login"){
            alert('請先登入帳號');
          }
        }
    });
  }
</script>