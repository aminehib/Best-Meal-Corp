<?php
session_start();
/*
if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}

$id = null ;

if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/pages/forms/modifier_Recette.php");
    exit();
}

$id = (int) $_GET["id"] ;


if(!$id){
    header("Location:/ProjetWeb/pages/forms/modifier_recette.php");
    exit();
}
*/
$id = 3 ;


require_once __DIR__."/../Autoload.php" ;
Autoload::register();

$db = new \gdb\RecepieDB();

$recepie = $db->getById($id);

if(!$recepie){
    $erreur = urlencode("La recette est introuvable") ;
    header("Location:/ProjetWeb/pages/forms/modifier_Recette.php?erreur=$erreur");
    exit();
}





$name = "" ;
$ingredients = null ;
$tags = null ;
$filename = null ;
$description  = null ;
$cookingTime = null ;





if(isset($_GET["name"])){
    $name = $_GET["name"];
}

if(isset($_GET["ingredients"])){
    $ingredients = $_GET["ingredients"] ;
}
if(isset($_GET["tags"] )){
    $tags = $_GET["tags"] ;
}

if(isset($_FILES["img"]) && $_FILES["img"]["error"] == 0){
    $filename = $_FILES["img"]["name"];
    $dir = __DIR__ ."/../pages/images/uploads";
    if(!is_dir($dir))mkdir($dir);
    move_uploaded_file($_FILES["img"]["tmp_name"],$dir. "/".$filename );

}


if(isset($_GET["cooking"])){
    $cookingTime = $_GET["cooking"] ;
}
$name = "anis" ;
if(!$name && !$ingredients && !$tags && !$filename && !$cookingTime) {
    $erreur = urlencode("Aucun champ n'a été rempli") ;
    header("Location:/ProjetWeb/pages/forms/modifier_Recette.php?erreur=$erreur");
    exit();
}


$db->update($id, $name ,"" ,$filename , $ingredients , $tags , 0);
header("Location:/ProjetWeb/pages/recettes.php");
exit();



