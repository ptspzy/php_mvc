<?php

require_once 'config.php';

header("Content-type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin: *');

try {
    $pdo = new PDO('mysql:dbname=' . DB . ';host=' . HOST, USERNAME, PASSWORD);
    $pdo->exec("set names utf8");
} catch (PDOException $e) {
    echo 'Connection failed:' . $e->getMessage();
}