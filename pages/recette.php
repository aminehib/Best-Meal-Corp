<?php   
session_start();


require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;

$id = null ;

if(!isset($_GET["id"])){
    header("Location:recettes.php") ;
    exit();
}

$id = (int) $_GET["id"];


if(!$id){
    header("Location:recettes.php") ;
    exit();
}


$db = new \gdb\RecepieDB();
$recette = $db->getById($id);



if(!$recette){
    header("Location:recettes.php") ;
}

$db = new \gdb\TagDB();
$tags = $db->getTags($id);

$tagsAll = $db->getAllTags();

$db = new \gdb\IngredientDB();
$ingredients = $db->getIngredients($id);
$ingredientsAll = $db->getAllIngredients();



include __DIR__."/recepie_copie.php";


