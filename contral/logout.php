<?php
require_once('../function.php');
session_start();
session_destroy();

echo alert_toindex('登出成功');
exit();

?>