<?php

try {
    $connection=new PDO("mysql:host=localhost;dbname=codeyad", "root", "");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";


}
catch (PDOException $e) {
    echo "Connection Error: "  . $e->getMessage();
}
?>