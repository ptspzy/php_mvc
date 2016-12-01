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
        $this->basicDir=__DIR__;
        spl_autoload_register(array($this, 'loader'));

    }

    private function loader($className) {
        $fileName = $this->basicDir.'/controllers/'.$className.'.php';

        if(file_exists($fileName)){
            require_once ($fileName);
        }
        $fileName = $this->basicDir.'/models/'.$className.'.php';
        if(file_exists($fileName)){
            require_once ($fileName);
        }
    }


}