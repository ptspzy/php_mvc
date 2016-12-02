<?php
/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-2
 * Time: 下午4:42
 */
for ($i = 0; $i < 10; $i++) {
    for ($j = 0; $j < 5; $j++) {
        echo $i . '@' . $j;
        if ($i % 2)
            break;
        echo '*|';
    }
    echo '#</br>';
}
?>