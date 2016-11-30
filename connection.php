<?php

require_once 'config.php';

class Db
{
    private static $instance = NULL;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            //$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:dbname='.DB.';host='.HOST, USERNAME, PASSWORD);
            self::$instance->exec("set names utf8");
        }
        return self::$instance;
    }
}

?>