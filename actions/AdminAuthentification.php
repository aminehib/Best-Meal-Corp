<?php
session_start();
require_once __DIR__."/../Autoload.php" ;
Autoload::register();

if(isset($_POST["username"]) && isset($_POST["password"])  ){
    $log = new classe\Admin();
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];
    $error = $log->connect( $username , $password) ; // On appelle la méthode de connexion de la classe Admin pour vérifier les identifiants de l'utilisateur et stocker le message d'erreur éventuel dans une variable
    if(empty($error)){
        $_SESSION["login"] = true ;// On stocke une variable de session pour indiquer que l'utilisateur est connecté
        $src = $_POST["source"]??"/ProjetWeb/pages/index.php"; // Si la source n'est pas définie, on redirige vers la page d'accueil
        header("Location:$src") ;// Redirection vers la page d'où l'utilisateur vient ou vers la page d'accueil si la source n'est pas définie
        exit();
    }else{
        $_SESSION["erreur"] = $error ; // On stocke le message d'erreur dans une variable de session pour l'afficher dans le formulaire de connexion
        header("Location:/ProjetWeb/pages/login.php") ; // Redirection vers le formulaire de connexion .
        exit();
    }
}else{
     $_SESSION["erreur"] = "Veuillez remplir tous les champs";
    header("Location:/ProjetWeb/pages/login.php") ; // Redirection vers le formulaire de connexion avec un message d'erreur si les champs ne sont pas remplis (Parce quue l'utilsateur peut arriver sur la pagesans passer par le formulaire de connexion)
    exit();
}

