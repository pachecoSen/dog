<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once "src/read.php";
    require_once "src/err.php";

    try {
        $read = new Read(__DIR__."/msg");
        $arg = array_filter($argv, function ($a){
            return 1 !== preg_match("/.php$/", $a);
        });

        if(empty($arg)){
            $read->setFile('empty.txt')->read();

            return;
        }

        $arg = array_map(function ($v){
            return strtolower($v);
        }, $arg);

        if(false === file_exists("app/{$arg[1]}.php")){
            $err = new Err("COMMANDS");
            throw new Exception($err->setCode('FoundCommand')->getMsg());
        }

        require_once "app/{$arg[1]}.php";

        $class = ucwords($arg[1]);
        $app = new $class($arg);

        $app->make();
    } catch (Exception $e) {
        echo "{$e->getMessage()}\n";
    }
?>