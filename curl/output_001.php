<?php
/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-8
 * Time: 下午5:41
 */

require_once('db.php');



$sql = <<<EOF
           SELECT
            id AS id,
            original AS imgO, 
            thumbnail AS imgT
           FROM
            town.image
           LIMIT 7000,3000            
EOF;

$rs = $pdo->query($sql);

$result_arr = $rs->fetchAll();

foreach ($result_arr as $key => $image) {
    save_img($image['imgO']);
    save_img($image['imgT']);
    $key++;
    echo "id: {$image['id']} 导出成功！已导出 {$key} 条记录！</br>";
}

function save_img($path)
{
    $host = "https://s3.cn-north-1.amazonaws.com.cn/res.augmn.cn/";
    $url = $host . $path;

    $dirs = explode("/", $path);

    $dir = $dirs[0] . '//' . $dirs[1] . '//' . $dirs[2] . '//' . $dirs[3] . '//';

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
}