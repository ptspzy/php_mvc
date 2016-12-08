<?php
/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-8
 * Time: 下午5:41
 */

require_once('db.php');


$rs = $pdo->query("SELECT original as img FROM image limit 5;");

$result_arr = $rs->fetchAll();

//print_r($result_arr);
//echo json_encode($result_arr,JSON_UNESCAPED_UNICODE);


$host ="https://s3.cn-north-1.amazonaws.com.cn/res.augmn.cn/";

foreach ($result_arr as $image){
   $src =  $host . $image['img']."";
    echo "<img src='{$src}'>";
}