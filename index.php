<?php
require_once('ClassAutoLoader.php');
new ClassAutoLoader();


require_once('connection.php');

//if (Db::getInstance()) {
//    echo 'MySQL connection is successful!';
//} else {
//    echo 'MySQL connection fails!';
//    return;
//}

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];

} else {
    $controller = 'datas';
    $action = 'test';
}

require_once('routes.php');
?>