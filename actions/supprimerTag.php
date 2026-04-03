<?php
session_start();

if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}



if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/recette.php");
    exit();
}


$id =(int) $_POST["id"] ;


if(!$id){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}

require_once __DIR__."/../Autoload.php" ;
Autoload::register();


$db = new \gdb\TagDB();

$tag = $db->getById($id);


if(!$tag){
    $erreur = urlencode("Tag introuvable") ;
    header("Location:/ProjetWeb/recette.php?erreur=$erreur");
    exit();
}


$db->delete($id);

header("Location:/ProjetWeb/recette.php");
exit();