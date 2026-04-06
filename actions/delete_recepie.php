<?php
session_start();


if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;

// On vérifie que l'id de la recette à supprimer est bien défini
$id = null ;
if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}

$id = (int)$_GET["id"];

// Si l'id n'est pas un entier ou n'est pas valide, on redirige vers la page de la recette
if(!$id){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit(); 
}



$db = new \gdb\RecepieDB();
$recette = $db->getById($id);

// Si la recette n'existe pas, on redirige vers la page de la recette avec une erreur
if(!$recette){
    $erreur = urldecode("Recette introuvable");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}

// On supprime la recette de la base de données
$db->delete($id);

header("Location:/ProjetWeb/pages/recettes.php") ;
exit();