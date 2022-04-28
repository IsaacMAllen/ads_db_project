<?php
    $host = 'localhost';
    $user = getenv('USER');
    $pass = getenv('PASS');
    $dbname = 'CS_2022_Spring_3430_101_t1';
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
