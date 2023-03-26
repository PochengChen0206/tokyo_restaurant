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

  <div class="untree_co-section">
    <div class="container">
      <div class="col-lg-12" style="border-top: 1px solid #d5d5d8; border-bottom: 1px solid #d5d5d8;">
        <h2 class="section-title text-left mt-3 mb-4">用餐心得</h2>
        <?php
        $sql = "SELECT * FROM `comment_info` a INNER JOIN `user_info` b ON a.`userID` = b.`userID` LEFT JOIN `comment_like` c ON c.`cID` = a.`id` WHERE a.`rID` = '".$rID."' AND c.`liked_userID` = a.`userID` ORDER BY a.`creat_date`";
        $stmt =  $dbpdo->prepare($sql);
        $stmt->execute();
        $result_comment = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_comment = count($result_comment);
        if($total_comment>0){
          $img = "";
          foreach($result_comment as $k=>$v){
            $check_userID = $v['userID'];
            $comment_id = $v['id'];
            if($v['user_image']!=""){
              $img = $v['user_image'];
            }else{
              $img = "../images/image_prepare.jpg";
            }
          ?>
            <div class="row ml-2 mb-3">
              <?php if(!isset($_GET['editid'])){ ?>
                <div class="col-1">
                  <img src="<?=$img?>" alt="Image" class="img-fluid mb-4 rounded-20">
                </div>
                <div class="col-11" style="background-color: #f4f4f5;">
                  <div class="row justify-content-between ml-1 mr-1">
                    <div><h5><?=$v['nickname']?></h5></div>
                    <div><?=$v['creat_date']?></div>
                  </div>
                  <div class="ml-1"><?=nl2br(htmlspecialchars($v['content']))?></div>
                  <div class="row ml-1" id="like_<?= $comment_id ?>" onclick="check_like(this.id);">
                    <?php if(isset($_SESSION['userID']) && ($v['liked_userID'] == $_SESSION['userID']) && ($v['like_status'] != "" && $v['like_status'] == "1")){ ?>
                      <div class="mr-1">
                        <i class="fa-solid fa-heart"></i>
                      </div>
                    <?php }else{ ?>
                      <div class="mr-1">
                        <i class="fa-regular fa-heart"></i>
                      </div>
                    <?php } ?>
                    <span id="sum_like_<?=$comment_id?>"><?= ($v['sum_like'] != "0" ? $v['sum_like'] : "") ?></span>
                  </div>
                  <?php if(isset($_SESSION['userID']) && ($check_userID == $_SESSION['userID'])){ ?>
                    <div class="row justify-content-end mr-2 mb-2">
                      <div class="mr-3">
                        <input type="button" id="edit_comment<?=$comment_id?>" onclick="editcomment(this.id);" name="edit_comment" value="編輯">
                      </div>
                      <div>
                        <input type="button" id="delete_comment<?=$comment_id?>" onclick="confirmdelete(this.id);" name="delete_comment" value="刪除">
                      </div>
                    </div>
                  <?php } ?>
                </div>
              <?php }elseif($_GET['editid']==$comment_id){ ?>
                <div class="col-1">
                  <img src="<?=$img?>" alt="Image" class="img-fluid mb-4 rounded-20">
                </div>
                <div class="col-11" style="background-color: #f4f4f5;">
                  <div class="row justify-content-between ml-1 mr-1">
                    <div><h5><?=$v['nickname']?></h5></div>
                    <div><?=$v['creat_date']?></div>
                  </div>
                  <form action="../contral/update_comment.php" method="post">
                    <div>
                      <textarea name="edit_content" id="edit_content" cols="60" rows="10"><?=$v['content']?></textarea>
                    </div>
                    <div class="row justify-content-end mr-2 mb-2">
                      <div class="mr-3">
                        <input type="hidden" name="comment_rID" value="<?=$rID?>">
                        <input type="hidden" name="comment_id" value="<?=$comment_id?>">
                        <input type="submit" value="儲存">
                      </div>
                      <div>
                        <input type="button" onclick="goback_comment();" value="返回用餐心得">
                      </div>
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
      <?php if(isset($_SESSION['userID']) && !isset($_GET['editid'])){ ?>
        <div class="col-lg-12 mt-3">
          <form action="../contral/insert_into.php" method="post" onsubmit="return content_check();">
          <?php 
          $sql = "SELECT * FROM `user_info` WHERE `userID` = '".$_SESSION['userID']."'";
          $stmt = $dbpdo->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $user_image = '';
          foreach($result as $r1){
            if($r1['user_image']!=""){
              $user_image = $r1['user_image'];
            }else{
              $user_image = "../images/image_prepare.jpg";
            }
          }
          ?>
          <div class="row ml-2">
            <div class="col-1">
              <a href="#">
                <img src="<?=$user_image?>" alt="Image" class="img-fluid mb-4 rounded-20">
              </a>
            </div>
            <div class="col-10">
              <textarea name="content" id="content" cols="100" rows="5"></textarea>
              <input type="hidden" name="comment_rID" value="<?=$rID?>">
              <input type="hidden" name="userID" value="<?=$_SESSION['userID']?>">
              <input type="hidden" name="nickname" value="<?=$_SESSION['name']?>">
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
    window.location.href="../view/restaurant_detail.php?rID=<?=$rID?>&page=1&editid=" + editid[1];
  }

  function goback_comment()
  {
    window.location.href="../view/restaurant_detail.php?rID=<?=$rID?>&page=1";
  }

  function check_like(id)
  {
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
        "cID": cID[1],
        "sum_like": sum_like_now
      },
        success: function(res) {
          // console.log(res);
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