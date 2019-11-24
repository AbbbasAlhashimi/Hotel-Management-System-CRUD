<?php

//database_connection.php
// $connect = new PDO("mysql:host=localhost;dbname=hall", "root", "axs23mn");

$host = '127.0.0.1';
$db   = 'hoteldb';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}