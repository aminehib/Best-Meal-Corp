<?php
session_start();


if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/panier.php?erreur=$erreur") ;
    exit();
}




require_once __DIR__."/../Autoload.php" ;
Autoload::register();



$name = "" ;

if(!empty($_GET["name"])){
    $name = $_GET["name"] ;
}


if(!$name){
    $erreur= urlencode("Le champ Name doit etre rempli") ;
    header("Location:/ProjetWeb/pages/panier.php?erreur=$erreur");
    exit();
}

$db = new \gdb\TagDB();
$db->addTag($name);

header("Location:/ProjetWeb/pages/panier.php");
exit();