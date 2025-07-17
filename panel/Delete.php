<?php
include "../Database/PDO-Connection.php";
$id=$_GET['id'];
$delete=$connection->prepare("DELETE FROM posts WHERE id=?");
$delete->bindParam(1,$id);
$delete->execute();
header("Location: posts.php");

?>