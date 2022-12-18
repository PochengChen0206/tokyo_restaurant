
<form action="../contral/login_connect.php" method="post" onsubmit="return login_check();">
  <table width="100%">
    <tr>
      <td align="center"><h3>請登入您的帳號</h3></td>
    </tr>
    <tr>
      <td align="center">信箱<input type="email" id="login_email" name="login_email" placeholder="請輸入email"></td>
    </tr>
    <tr>
      <td align="center">密碼<input type="password" id="login_password" name="login_password" placeholder="請輸入密碼"></td>
    </tr>
    <tr>
      <td align="center"><input type="submit" value="登入"></td>
    </tr>
  </table>
</form>
  <br>
  <br>
<form action="../contral/signup_connect.php" method="post" onsubmit="return signup_check();">
  <table width="100%">
    <tr>
      <td align="center"><h3>第一次使用</h3></td>
    </tr>
    <tr>
      <td align="center">姓名<input type="user_name" id="signup_user_name" name="signup_user_name" placeholder="請輸入使用者名字"></td>
    </tr>
    <tr>
      <td align="center">信箱<input type="email" id="signup_email"  name="signup_email" placeholder="請輸入email作為帳號"></td>
    </tr>
    <tr>
      <td align="center">密碼<input type="password" id="signup_password" name="signup_password" placeholder="請輸入密碼"></td>
    </tr>
    <tr>
      <td align="center"><input type="submit" value="註冊"></td>
    </tr>
  </table>
</form>
<table width="100%">
  <tr>
    <td><a type="button" href="../index.php">回首頁</a></td>
  </tr>
</table>
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