<?php
session_start();


require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;

$db = new \gdb\RecepieDB();


$recepies = [] ;

$name =  $_GET["nom"];
$ingredients = $_GET["ingredient"];
$tag =  $_GET["tag"] ;




$byName = [] ;
$byIng = [] ;
$byTag = [] ;


$nameId= [] ;
$ingId= [] ;
$tagId= [] ;



if(empty($name) && empty($ingredients) && empty($tag)){
    header("Location:/ProjetWeb/pages/recettes.php");
    exit();
    
}





if(!empty($name)){
    $byName = $db->getRecepiesByTitle($name);
    $nameId = [] ;
    foreach($byName as $rec){
        array_push($nameId ,$rec->id);
    }
    if(count($byName)== 0){
        
    }

}


[1,2,5];







if(!empty($ingredients)){
    $byIng = $db->getRecepiesByIngredients($ingredients);
    $ingId= [] ;
    foreach($byIng as $rec){
        array_push($ingId , $rec->id);
    }
    if(count($byIng)== 0){

    }

}








if(!empty($tag)){

    $byTag = $db->getRecepiesByTags($tag) ;
    $tagId= [] ;
    foreach($byTag as $rec){
        array_push($tagId , $rec->id);
    }

    if(count($tagId)== 0){
        header("Location:/ProjetWeb/pages/recettes.php?n=");
        exit();
    }

}




if(!empty($nameId)){
    if(empty($ingId))$ingId = $nameId ;
    if(empty($tagId))$tagId = $nameId ;

}


if(!empty($ingId)){
    if(empty($nameId))$nameId = $ingId ;
    if(empty($tagId))$tagId = $ingId ;

}

if(!empty($tagId)){
    if(empty($ingId))$ingId = $tagId ;
    if(empty($nameId))$nameId = $tagId ;
}






$result = array_intersect($nameId,$ingId , $tagId) ;






foreach($result as $id){
    array_push($recepies ,$db->getById($id) ) ;
}




ob_start();
foreach($recepies as $recepie){
    $recepie->getHTML();
}
$content = ob_get_clean();
$_SESSION["recherche"] = $content ;



header("Location:/ProjetWeb/pages/recettes.php");
exit();












