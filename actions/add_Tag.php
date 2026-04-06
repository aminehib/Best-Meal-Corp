<?php
session_start();


if(!isset($_SESSION["login"])){
    $_SESSION["erreur"] = "Accès Interdit";
     header("Location:/ProjetWeb/pages/panier.php") ;
     exit() ;
}




require_once __DIR__."/../Autoload.php" ;
Autoload::register();



$name = "" ;

// On vérifie que le champ name est bien défini et n'est pas vide
if(!empty($_POST["name"])){
    $name = $_POST["name"] ;
}

// Si le champ name est vide, on redirige vers la page de panier avec une erreur
if(!$name){
    $_SESSION["erreur"] = "Le champ Name doit etre rempli";
     header("Location:/ProjetWeb/pages/panier.php") ;
     exit() ;
}

$db = new \gdb\TagDB();
// On ajoute le tag à la base de données
$db->addTag($name);

header("Location:/ProjetWeb/pages/panier.php");
exit();