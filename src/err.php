<?php

class Err {
    private $dictionary;
    private $segmento;
    private $code;
    private $xml;
    private $data_group;
    
    function __construct($strSegmento){
        $this->dictionary = __DIR__."/resources/err.xml";
        $this->segmento = $strSegmento;
        $this->setXML();
        $this->setDataGroup();
    }

    public function setCode($strCode){
        $this->code = $strCode;

        return $this;
    }

    public function getMsg(){
        $code = $this->code;
        $msg = $this->data_group->$code;

        return "Err{$code}: {$msg}";
    }

    private function setXML(){
        $this->xml = simplexml_load_file($this->dictionary);
    }

    private function setDataGroup(){
        $segmento = $this->segmento;

        $this->data_group = $this->xml->$segmento;
    }
}