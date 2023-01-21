<?php
require_once('../DBPDO.php');
$check_search = array();
foreach($_POST as $k=>$v){
  //使用strip_tags避免area的連接符號造成亂碼
  $check_search[$k]=strip_tags($v);
}

$select = http_build_query($check_search);

echo "<script>window.location.href='http://localhost/pocheng/tokyo_restaurant/view/restaurant_search.php?&$select&page=1'</script>";
exit();

?>
