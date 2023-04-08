<?php
require_once('../DBPDO.php');
$id = $_POST['comment_id'];
$content = $_POST['edit_content'];
$rID = $_POST['comment_rID'];

$sql = "UPDATE `comment_info` SET `content` = :content WHERE `id` = :id";
$stmt = $dbpdo->prepare($sql);
$stmt->bindParam(':content', $content,PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();

echo "<script>window.location.href='../view/restaurant_detail.php?rID=$rID'</script>";
exit();
?>