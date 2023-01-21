<!-- /*
* Template Name: Tour
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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
          <h2 class="mb-3 text-white">忘記密碼</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="untree_co-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <form class="contact-form" data-aos="fade-up" data-aos-delay="200" action="../contral/login_connect.php" method="post" onsubmit="return login_check();">
            <div class="row justify-content-center">
              <h2 class="section-title text-center mb-3">請輸入會員信箱</h2>
            </div>
            <div class="form-group">
              <label class="text-black" for="email">信箱</label>
              <input type="email" class="form-control" id="login_email" name="login_email" placeholder="請輸入email" required>
            </div>
            <div class="form-group">
              <label class="text-black" for="email">密碼</label>
              <input type="password" class="form-control" id="login_password" name="login_password" placeholder="請輸入密碼" required>
            </div>
            <div class="row justify-content-center">
              <button type="submit" class="col-4 btn btn-primary mt-2">送出</button>
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