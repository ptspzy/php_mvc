<?php
/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-8
 * Time: 下午5:28
 */
$ch = curl_init("http://www.baidu.com/");
$fp = fopen("example_homepage.txt", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);