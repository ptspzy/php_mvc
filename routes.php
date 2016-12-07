<?php

function call ($controller,$action){

    //首字母大写
    $controller = ucfirst($controller)."Controller";

    $controller = new $controller();
    $controller->{$action}();
}

$controllers = array(
    'pages' => ['home', 'error'],
    'posts' => ['index', 'show'],
    'datas' =>['test','showArticleChart','showChapterChart']
);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}
?>