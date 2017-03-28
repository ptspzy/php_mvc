<?php
require_once 'lib/ClassAutoLoader.php';
new ClassAutoLoader();

require_once('db/connection.php');

new PagesController();

// if (Db::getInstance()) {
//    echo 'MySQL connection is successful!';
// } else {
//    echo 'MySQL connection fails!';
//    return;
// }

// ?controller=index&action=index
if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];

} else {
    $controller = 'index';
    $action = 'index';
}

require_once('config/routes.php');
?>