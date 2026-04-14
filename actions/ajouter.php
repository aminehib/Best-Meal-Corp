<?php
if(session_status() === PHP_SESSION_NONE){
 session_start();
}
// Traite la création complète d'une recette depuis le formulaire d'administration.


if(!isset($_SESSION["login"])){
    $_SESSION["erreur"] = "Accès Interdit";
     header("Location:/ProjetWeb/pages/recettes.php") ;
     exit() ;
}

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;


$name = "" ;
$ingredients = [] ;
$tags = [] ;
$filename = null ;
$description  = null ;
$cookingTime = null ;
$preparationTime = null ;
$servings = null ;
$preparation = null ;



if(isset($_POST["preparation_time"])){
    $preparationTime = (int)$_POST["preparation_time"] ;
}


if(isset($_POST["preparation"])){
    $preparation= $_POST["preparation"] ;
}



if(isset($_POST["description"])){
    $description = $_POST["description"];
}


if(isset($_POST["servings"])){
    $servings = (int) $_POST["servings"] ;
}



if(isset($_POST["title"])){
    $name = $_POST["title"];
}

if(!$name){
    $_SESSION["erreur"] = "Le champ title doit etre rempli";
     header("Location:/ProjetWeb/pages/forms/ajouter.php") ;
     exit() ;
}


if(isset($_POST["ingredients"])){
    $ingredients = $_POST["ingredients"] ;
}
if(isset($_POST["tags"] )){
    $tags = $_POST["tags"] ;
}

if(isset($_FILES["img"]) && $_FILES["img"]["error"] == 0){
    
    $filename = $_FILES["img"]["name"];
    $dir = __DIR__ ."/../pages/images/uploads/". $filename;
    if(move_uploaded_file($_FILES["img"]["tmp_name"], $dir) == false){
        $_SESSION["erreur"] = "Erreur lors de l'upload de l'image" ;
        header("Location:/ProjetWeb/pages/forms/ajouter.php") ;
        exit();
    };
}


if(isset($_POST["cooking_time"])){
    $cookingTime = (int)$_POST["cooking_time"] ;
}

// Si aucun champ n'est rempli, on affiche une erreur
if(!$name && !$ingredients && !$tags && !$filename && !$cookingTime && !$preparationTime && !$servings && !$description &&!$preparation ){
    $_SESSION["erreur"] = "Aucun champ n'a été rempli" ;
     header("Location:/ProjetWeb/pages/forms/ajouter.php") ;
     exit() ;
}



$db = new \gdb\RecepieDB();



// On ajoute la recette à la base de données
$db->addRecepie($name ,$description,$ingredients , $tags ,$filename ,$preparationTime, $preparation, $cookingTime ,$servings ) ;   





header("Location:/ProjetWeb/pages/recettes.php");
exit();


