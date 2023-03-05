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
          <form class="contact-form" data-aos="fade-up" data-aos-delay="200" action="../contral/reset_password.php" method="post" onsubmit="return restpwd_email_check();">
            <div class="row justify-content-center">
              <h2 class="section-title text-center mb-3">請輸入會員信箱</h2>
            </div>
            <div class="form-group">
              <label class="text-black" for="email">信箱</label>
              <input type="email" class="form-control" id="restpwd_email" name="restpwd_email" placeholder="請輸入您的email，系統將寄送新的密碼到您的email" required>
            </div>
            <div class="row justify-content-center">
              <button type="submit" class="col-4 btn btn-primary mt-2">寄送新密碼</button>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>

  <?php require_once('../view/footer.php'); ?>
  <?php require_once('../view/src_js.php'); ?>
</body>
</html>
<script>
  function restpwd_email_check(){
    var check_restpwd_email = $('#restpwd_email').val();
    if(check_restpwd_email == ""){
      alert("請輸入email");
      return false;
    }
  }
</script>