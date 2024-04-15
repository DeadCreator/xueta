<?php


$db_user = 'root';
$db_pass = 'mysql';
$db_name = 'politex';
$db_host = 'localhost';

try {
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}