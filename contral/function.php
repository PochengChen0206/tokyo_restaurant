<?php
require_once('../DBPDO.php');
//index
function make_tmp_password($length)
{
  $text = "0123456789!@#$%abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $str = "";
  while(strlen($str) < $length){
    $str .= substr($text, rand(0, strlen($text)), 1);
  }
  return $str;
}

function alert_toindex($text)
{
  $text = "<script>alert('".$text."');window.location.href='../index.php'</script>";
  return $text;
}

function alert_topre($text)
{
  $text = "<script>alert('".$text."');window.history.back(-1);</script>";
  return $text;
}


?>