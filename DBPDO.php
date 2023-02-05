<?php
$dbhost = 'localhost'; 
$dbuser = 'root';
$dbpasswd = '';
$dbname = 'tokyo_restaurant';
$dbcharacter = 'utf8mb4';
try
{
  $dbpdo = new PDO("mysql:host={$dbhost};dbname={$dbname};charset={$dbcharacter}", $dbuser, $dbpasswd);
  $dbpdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //禁用prepared statements的模擬效果
  $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //讓資料庫顯示錯誤原因
  // echo "連線成功";
} catch (PDOException $e) {
  die("無法連上資料庫：" . $e->getMessage());
}

session_start();
?>