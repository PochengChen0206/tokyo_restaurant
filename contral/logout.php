<?php
require_once('../contral/function.php');
session_destroy();

header("Location:../index.php");
exit();

?>