<?php
require_once('../contral/function.php');
session_start();
session_destroy();

echo alert_toindex('登出成功');
exit();

?>