<?php
/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-8
 * Time: 下午5:44
 */


header("Content-type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin: *');

$dsn = 'mysql:dbname=town;host=123.206.44.122';
$user = 'ptspzy';
$password = 'mysqlpts';

try{
    $pdo = new PDO($dsn,$user,$password);
    $pdo->exec("set names utf8");
    //echo 'OK';
}catch (PDOException $e){
    echo 'Connection failed:'.$e->getMessage();
}