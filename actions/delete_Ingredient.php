<?php
session_start();


if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;


$id = null ;

if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/pages/panier.php") ;
    exit();
}


$id = (int) $_GET["id"] ;

if(!$id){
    header("Location:/ProjetWeb/pages/panier.php") ;
    exit();
}



$db = new \gdb\IngredientDB();
$ingredient = $db->getById($id);    
if(!$ingredient){
    $erreur = urldecode("Ingredient introuvable");
    header("Location:/ProjetWeb/pages/panier.php?erreur=$erreur") ;
    exit();
}


$db->deleteIngredient($id);
header("Location:/ProjetWeb/pages/panier.php") ;
exit();