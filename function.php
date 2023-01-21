<?php
function alert_toindex($text){
  $text = "<script>alert('".$text."');window.location.href='../index.php'</script>";
  return $text;
}

function alert_topre($text){
  $text = "<script>alert('".$text."');window.history.back(-1);</script>";
  return $text;
}
?>