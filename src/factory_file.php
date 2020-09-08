<?php

class FactoryFile {
    private $dictionary;
    private $book;
    private $resource;
    private $text;
    private $name;
    private $ext;

    function __construct($path = __DIR__.'/../'){
        $this->dictionary = $path;
        $this->book =__DIR__.'/resources/make.xml';
        $this->text='';
        $this->name='File_'.time();
        $this->ext='txt';
    }

    public function geoResource($resource){
        $xml = simplexml_load_file($this->book);
        $this->resource = $xml->$resource;

        return $this;
    }

    public function setText($text){
        $this->text = $text;

        return $this;
    }

    public function setName($name=null){
        $this->name=$name;

        return $this;
    }

    public function setExt($ext){
        $this->ext=$ext;

        return $this;
    }

    public function xmlToArray(){
        return json_decode(json_encode($this->resource), true);
    }

    public function fileCreate(){
        $name="{$this->name}.{$this->ext}";
        $file = fopen("{$this->dictionary}{$name}", 'w');

        fwrite($file, $this->text);

        fclose($file);
    }
}