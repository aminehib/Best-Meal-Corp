<?php
session_start();


if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}



//id


require_once __DIR__."/../Autoload.php" ;
Autoload::register();


$db = new \gdb\TagDB();

$tag = $db->getById($id);

if(!$tag){
    $erreur = urldecode("Tag introuvable") ;
    header("Location:/ProjetWeb/pages/forms/modifier_Tag.php?erreur=$erreur");
    exit();
}




$name = null ;

if(!empty($_GET["name"])){
    $name = $_GET["name"] ;
}


if(!$name){
    $erreur= urlencode("Le champ Name doit etre rempli") ;
    header("Location:/ProjetWeb/pages/forms/modifier_Tag.php?erreur=$erreur");
    exit();
}


$db->update($id , $name);
header("Location:/ProjetWeb/pages/recette.php");
exit();