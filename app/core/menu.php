<?php

require_once __DIR__."/../../src/err.php";
require_once __DIR__."/../../src/read.php";

abstract class Menu{
    private $args;
    private $name;
    protected $path_msg = __DIR__."/../../msg";

    abstract protected function make();
    abstract protected function help();
}