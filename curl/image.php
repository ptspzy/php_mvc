<?php
/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-8
 * Time: 下午5:32
 */
function return_dir($str){
    $dirs = explode("//",$str);

}


$host = "https://s3.cn-north-1.amazonaws.com.cn/res.augmn.cn/";

$path = "image/20161014/VenueProfileBackground/std/751ad80bcce54126baf8f8e724c2a04d";

$url = $host . $path;

$dirs = explode("/",$path);
print_r($dirs);
$dir = $dirs[0].'//'.$dirs[1].'//'.$dirs[2].'//'.$dirs[3].'//';

$curl = curl_init($url);

//创建文件夹
mkdir($dir, 0777, true);


$filename = $dir . $dirs[4] . ".jpg";

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$imageData = curl_exec($curl);
curl_close($curl);

$tp = @fopen($filename, 'a');
fwrite($tp, $imageData);
fclose($tp);

