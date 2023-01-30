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
            <h2 class="mb-3 text-white">請輸入註冊資料</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="untree_co-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <form class="contact-form" data-aos="fade-up" data-aos-delay="200" action="../contral/signup_connect.php" method="post" onsubmit="return signup_check();">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label class="text-black" for="fname">姓名</label>
                  <input class="form-control" type="text" id="signup_user_name" name="signup_user_name" placeholder="請輸入會員名字" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label class="text-black" for="lname">暱稱</label>
                  <input class="form-control" type="text" id="signup_nickname" name="signup_nickname" placeholder="請輸入會員暱稱" required>
                  <!-- DB再新增欄位 -->
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="text-black" for="email">電子信箱</label>
              <input class="form-control" type="email" id="signup_email"  name="signup_email" placeholder="請輸入email作為帳號" required>
            </div>
            <div class="form-group">
              <label class="text-black" for="message">密碼</label>
              <input class="form-control" type="password" id="signup_password" name="signup_password" placeholder="請輸入密碼" required>
            </div>
            <div class="form-group">
              <label class="text-black" for="message">確認密碼</label>
              <input class="form-control" type="password" id="signup_password_check" name="signup_password_check" placeholder="請再次輸入密碼" required>
              <!-- 查詢確認密碼功能 -->
            </div>
            <div class="row justify-content-center">
              <button type="submit" class="col-4 btn btn-primary mt-2">註冊</button>
            </div>
          </form>
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
  function signup_check(){
    var signup_user_name = $('#signup_user_name').val();
    var signup_nickname = $('#signup_nickname').val();
    var signup_email = $('#signup_email').val();
    var signup_password = $('#signup_password').val();
    var signup_password_check = $('#signup_password_check').val();

    if(signup_user_name==""){
      alert("請輸入會員名字進行註冊");
      return false;
    }
    if(signup_nickname==""){
      alert("請輸入會員暱稱進行註冊");
      return false;
    }
    if(signup_email==""){
      alert("請輸入email進行註冊");
      return false;
    }
    if(signup_password==""){
      alert("請輸入密碼進行註冊");
      return false;
    }
    if(signup_password_check==""){
      alert("請輸入確認密碼進行註冊");
      return false;
    }

    if(signup_password!=signup_password_check){
      alert("請重新確認密碼進行註冊");
      return false;
    }
  }
</script>