<?php
session_start();
if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;

$name = null ;
$ingredients = null ;
$tags = null ;
$filename = null ;
$description  = null ;
$cookingTime = null ;



if(isset($_GET["name"])){
    $name = $_GET["name"];
}

if(isset($_T["ingredients"])){
    $ingredients = $_GET["ingredients"] ;
}
if(isset($_GET["tags"] )){
    $tags = $_GET["tags"] ;
}

if($_FILES["img"]["error"] == 0){
    $filename = $_FILES["img"]["name"];
    $dir = __DIR__ ."/../pages/images/uploads";
    if(!is_dir($dir))mkdir($dir);
    move_uploaded_file($_FILES["img"]["tmp_name"],$dir. "/".$filename );

}


if(isset($_GET["cooking"])){
    $cookingTime = $_GET["cooking"] ;
}

if(!$name && !$ingredients && !$tags && !$filename && !$cookingTime ){
    $erreur = urlencode("Aucun champ n'a été rempli") ;
    header("Location:/ProjetWeb/pages/forms/modifier.php?erreur=$erreur");
    exit();
}



$db = new \gdb\RecepieDB();
$db->add($name ,$filename , $ingredients , $tags);


header("Location:/ProjetWeb/pages/recettes.php");
exit();




