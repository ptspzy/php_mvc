<?php
/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-8
 * Time: 下午5:32
 */
$url = "https://s3.cn-north-1.amazonaws.com.cn/res.augmn.cn/image/20161014/VenueProfileBackground/std/751ad80bcce54126baf8f8e724c2a04d";
$curl = curl_init($url);

$structure = '../image/20161014/VenueProfileBackground/std/';

if (!mkdir($structure, 0777, true)) {
    //die('Failed to create folders...');
}
$filename = $structure.date("Ymdhis").".jpg";


curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
$imageData = curl_exec($curl);
curl_close($curl);

$tp = @fopen($filename, 'a');
fwrite($tp, $imageData);
//move_uploaded_file($filename, "1");
fclose($tp);

