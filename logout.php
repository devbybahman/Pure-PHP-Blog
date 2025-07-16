<?php
session_start();
include("Database/PDO-Connection.php");
session_destroy();
header('Location:./login.php');
?>









