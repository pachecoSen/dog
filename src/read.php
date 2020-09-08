<?php
require_once "err.php";

class Read {
    private $base_path;
    private $file;
    private $path_err;

    function __construct($strBasePath){
        $this->path_err = new Err("PATH");
        if(true !== is_dir($strBasePath))
            throw new Exception($this->path_err->setCode("NoPath")->getMsg());

        $this->base_path = $strBasePath;
        $this->file = "";
    }

    public function setFile($strFile){
        $path = "{$this->base_path}/{$strFile}";
        if(true !== is_file($path))
            throw new Exception($this->path_err->setCode("NoPath")->getMsg());

        $this->file = $path;

        return $this;
    }

    public function read(){
        $menu = fopen($this->file, "r");
        $txtMenu = "";
        while (!feof($menu))
            $txtMenu .= fgets($menu);
        fclose($menu);
        
        echo "{$txtMenu}\n";
    }
}