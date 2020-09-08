<?php
require_once 'core/menu.php';
require_once __DIR__."/../src/factory_file.php";

class Make extends Menu{
    private $path_err;
    private $read;
    private $factoryFile;

    function __construct($args){
        $this->path_err = new Err('COMMANDS');
        $this->read = new Read($this->path_msg);
        $this->factoryFile = new FactoryFile();
        $this->name = 'make';
        $this->args = $args;
    }

    public function make(){
        if($this->args[1] !== $this->name)
            throw new Exception($this->path_err->setCode('NoCommand')->getMsg());

        if(!isset($this->args[2]) || 'help' === $this->args[2]){
            $this->help();

            return false;
        }

        $metodo = $this->args[2];
        if(!method_exists($this, $metodo))
            throw new Exception($this->path_err->setCode('WrongParameter')->getMsg());

        $this->$metodo();

        return false;
    }

    protected function help(){
        $this->read->setFile('make.txt')->read();
    }

    private function htaccess(){
        $subParametro = array_slice($this->args, 2);
        $make_htaccess = $this->factoryFile->geoResource('htaccess')->xmlToArray();
        $apache = implode("\n", $make_htaccess['APACHE']['row']);
        $php = $make_htaccess['PHP'];
        if(empty($subParametro)){
            $this->factoryFile->setText($apache)
                ->setName()->setExt('htaccess')->fileCreate();

            return false;
        }
    }
}