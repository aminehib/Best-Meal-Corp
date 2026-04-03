<?php
session_start();


if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/panier.php?erreur=$erreur") ;
    exit();
}

$id = null ;

if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}

$id = (int) $_GET["id"] ;


if(!$id){
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}




require_once __DIR__."/../Autoload.php" ;
Autoload::register();


$db = new \gdb\TagDB();

$tag = $db->getById($id);

if(!$tag){
    $erreur = urlencode("Tag introuvable") ;
    header("Location:/ProjetWeb/pages/panier.php?erreur=$erreur");
    exit();
}



$db->deleteTag($id);

header("Location:/ProjetWeb/pages/panier.php");
exit();