<?php
session_start();


if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;

if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}

$id = (int)$_GET["id"];

if(!$id){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}



$db = new \gdb\RecepieDB();
$recette = $db->getById($id);

if(!$recette){
    $erreur = urldecode("Recette introuvable");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}

$db->delete($id);

header("Location:/ProjetWeb/pages/recettes.php") ;
exit();