<?php

abstract class configController {
    var $config;
    
    public function __construct(){
        $this->config = yaml_parse_file(PATHROOT.DS.'conf'.DS.'parameters.yml');
    }
    function getConfig(){
        return $this->config;
    }
    function setConfig($config){
        $this->config = $config;
    }
    function getConfigParameter($parameter){
        if(key_exists($parameter , $this->config)){
        return $this->config[$parameter];
    }
}
}