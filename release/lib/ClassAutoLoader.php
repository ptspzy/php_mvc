<?php

/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-1
 * Time: 上午11:40
 */
class ClassAutoLoader
{
    private $basicDir;

    public function __construct()
    {
        $this->basicDir= __DIR__;//TODO: set require_once static path
        spl_autoload_register(array($this, 'loader'));
    }

    private function loader($className) {
        $fileName = 'controllers/'.$className.'.php';
        if(file_exists($fileName)){
            require_once($fileName);
        }

        $fileName = 'models/'.$className.'.php';
        if(file_exists($fileName)){
            require_once($fileName);
        }
    }


}