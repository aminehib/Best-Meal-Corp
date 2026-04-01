<?php
session_start();
require_once __DIR__."/../Autoload.php";
Autoload::register();


$content = "" ;

if(isset($_SESSION["recherche"])){

    $content = $_SESSION["recherche"] ;
    if(empty($content)){
        $content =  "<script src =\"js/recherche.js\" ></script>" ;
    }
    unset($_SESSION["recherche"]);

}else{
    
    $db = new \gdb\RecepieDB();
    
    $recepies = $db->getAllRecepies();
    ob_start();
    foreach($recepies as $recepie){
        $recepie->getHTML();
    }   
    $content = ob_get_clean();

}

\classe\Template::render($content);





