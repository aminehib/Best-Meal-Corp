<?php
session_start();
require_once __DIR__."/../Autoload.php";
Autoload::register();


$content = "" ;

if(isset($_GET["content"])){

    $content = $_GET["content"] ;
    if(empty($content)){
        $content =  "<script src =\"js/recherche.js\" ></script>" ;
    }

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





