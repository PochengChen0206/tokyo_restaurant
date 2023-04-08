<div class="untree_co-section">
  <div class="container">
    <div class="col-lg-12" style="border-top: 1px solid #d5d5d8; border-bottom: 1px solid #d5d5d8;">
      <h2 class="section-title text-left mt-3 mb-4">用餐心得</h2>
      <?php
      //取得當前頁數
      $page = "";
      if(isset($_GET['page']) && $_GET['page'] > 0){
        $page = $_GET['page'];
      }else{
        $page = 1;
      }
      //取得此餐廳的所有留言數
      $sql = "SELECT `id` FROM `comment_info` WHERE `rID` = '".$rID."'";
      $stmt =  $dbpdo->prepare($sql);
      $stmt->execute();
      $get_comment = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $get_comment = count($get_comment);
      
      $limit = 5; //一頁顯示筆數
      $max_page = ceil($get_comment / $limit);
      $offset = ($page - 1) * $limit;

      $sql = "SELECT a.*, b.`user_image` 
              FROM `comment_info` a 
              LEFT JOIN `user_info` b ON a.`userID` = b.`userID` 
              WHERE a.`rID` = '".$rID."' 
              ORDER BY a.`creat_date`
              LIMIT ".$limit."
              OFFSET ".$offset."
              ";

      $stmt =  $dbpdo->prepare($sql);
      $stmt->execute();
      $result_comment = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $total_comment = count($result_comment);

      $img = "";
      unset($arr_comment_info); //將取出的資料另存陣列
      $check_cID = ""; //存入此餐廳所有的留言cID
      foreach($result_comment as $k=>$v){
        if($v['user_image']!=""){
          $img = $v['user_image'];
        }else{
          $img = "../images/image_prepare.jpg";
        }
        $arr_comment_info[] = [
          'comment_id' => $v['id'],
          'userID'=> $v['userID'],
          'user_image' => $img,
          'nickname' => $v['nickname'],
          'creat_date' => $v['creat_date'],
          'content' => $v['content'],
          'sum_like' => $v['sum_like']
        ];
        //將$check_cID存成下方判斷WHERE IN 的格式
        if($check_cID != ""){
          $check_cID .= "','";
        }
        $check_cID .= $v['id'];
      }
      $liked_userID = "";
      if(isset($_SESSION['userID'])){
        $liked_userID = $_SESSION['userID'];
      }
        
      $sql2 = "SELECT `cID` 
              FROM `comment_like` 
              WHERE `liked_userID` = '".$liked_userID."'
              AND `rID` = '".$rID."' 
              AND `cID` IN ( '".$check_cID."' 
              )";

      $stmt2 =  $dbpdo->prepare($sql2);
      $stmt2->execute();
      $result_like = $stmt2->fetchAll(PDO::FETCH_ASSOC);

      $liked_comment_id = array(); //按過like的comment_id
      foreach($result_like as $v){
        $liked_comment_id[] = $v['cID'];
      }

      if($total_comment > 0){
        foreach($arr_comment_info as $k=>$v){
          $check_userID = $v['userID'];
          $comment_id = $v['comment_id'];
        ?>
          <div class="row ml-2 mb-3">
            <?php if(!isset($_GET['editid'])){ ?>
              <div class="col-1">
                <img src="<?=$v['user_image']?>" alt="Image" class="img-fluid mb-4 rounded-20">
              </div>
              <div class="col-11" style="background-color: #f4f4f5;">
                <div class="row justify-content-between ml-1 mr-1">
                  <div><h5><?=$v['nickname']?></h5></div>
                  <div><?=$v['creat_date']?></div>
                </div>
                <div class="ml-1"><?=nl2br(htmlspecialchars($v['content']))?></div>
                <div class="row ml-1" id="like_<?= $comment_id ?>" onclick="check_like(this.id);">
                  <?php if(isset($_SESSION['userID']) && in_array($comment_id, $liked_comment_id)){  //已按過like?>
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
            <?php }elseif($_GET['editid'] == $comment_id){ //編輯留言?>
              <div class="col-1">
                <img src="<?=$v['user_image']?>" alt="Image" class="img-fluid mb-4 rounded-20">
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
          <div class="row justify-content-center">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item <?=$page == 1 ? 'disabled' : ''?>">
                  <a class="page-link" href="../view/restaurant_detail.php?rID=<?=$rID?>&page=1">第一頁</a>
                </li>
                <li class="page-item <?=$page == 1 ? 'disabled' : ''?>">
                  <a class="page-link" href="../view/restaurant_detail.php?rID=<?=$rID?>&page=<?($page - 1)?>">前一頁</a>
                </li>
                <?php for($i = 1; $i <= $max_page; $i++){ ?>
                  <li class="page-item <?= $page == $i ? 'active' : ''?>">
                    <a class="page-link" href="../view/restaurant_detail.php?rID=<?=$rID?>&page=<?= $i ?>"><?= $i ?></a>
                  </li>
                <?php } ?>
                <li class="page-item <?=$page == $max_page ? 'disabled' : ''?>">
                  <a class="page-link" href="../view/restaurant_detail.php?rID=<?=$rID?>&page=<?=($page + 1)?>">下一頁</a>
                </li>
                <li class="page-item <?=$page == $max_page ? 'disabled' : ''?>">
                  <a class="page-link" href="../view/restaurant_detail.php?rID=<?=$rID?>&page=<?= $max_page ?>">最後一頁</a>
                </li>
              </ul>
            </nav>
          </div>
      <?php }else{ ?>
      <div class="row ml-2"><p>目前尚未有心得分享</p></div>
      <?php } ?>
    </div>
    <!-- 登入帳號時填寫留言 -->
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