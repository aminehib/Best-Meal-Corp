<?php

class Autoload{

    public static function autoload($className){
        $className = str_replace("\\" , "/" , $className);
        require_once __DIR__. "/".$className. ".php" ;
    }

    public static function register(){
        spl_autoload_register([self::class , "autoload"]) ;
    }

}