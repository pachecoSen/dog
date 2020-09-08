<?php
require_once "core/menu.php";

class Help extends Menu{
    private $path_err;
    private $read;

    function __construct($args){
        $this->path_err = new Err("COMMANDS");
        $this->read = new Read($this->path_msg);
        $this->name = 'help';
        $this->args = $args;
    }

    public function make(){
        if($this->args[1] !== $this->name)
            throw new Exception($this->path_err->setCode("NoCommand")->getMsg());

        $this->read->setFile('menu.txt')->read();
    }
}