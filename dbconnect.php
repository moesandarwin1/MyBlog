<?php

try {
    $host = "localhost";
    $dbname = "myblogb3";
    $dbuser = "root";
    $dbpassword = "";

    //Data source name
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn,$dbuser,$dbpassword);

    //

    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "connection success";

} catch (PDOException $e) {
    die("Connection fail:".$e->getMessage());
}



?>