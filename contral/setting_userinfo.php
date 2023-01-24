<?php
require_once('../DBPDO.php');
$user_name = $_POST['setting_user_name'];
$nickname = $_POST['setting_nickname'];
$email = $_POST['setting_email'];

$sql = "UPDATE `user_info` SET `user_name` = :user_name, `nickname` = :nickname, `email` = :email, `created_date` = NOW() WHERE `userID` = '11'";
$stmt = $dbpdo->prepare($sql);
$stmt->bindParam(':user_name',$user_name,PDO::PARAM_STR);
$stmt->bindParam(':nickname',$nickname,PDO::PARAM_STR);
$stmt->bindParam(':email',$email,PDO::PARAM_STR);
$stmt->execute();

echo "<script>alert('個人資料已更新');window.location.href='http://localhost/pocheng/tokyo_restaurant/view/mypage.php?cate=userinfo'</script>";
exit();

?>