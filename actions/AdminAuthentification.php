<?php
session_start();
require_once __DIR__."/../Autoload.php" ;
Autoload::register();

if(isset($_POST["username"]) && isset($_POST["password"])  ){
    $log = new classe\Admin();
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];
    $error = $log->connect( $username , $password) ;
    if(empty($error)){
        $_SESSION["login"] = true ;
        $src = $_POST["source"] ;
        header("Location:$src") ;
        exit();
    }else{
        header("Location:/ProjetWeb/pages/login.php?error=$error") ;
        exit();
    }

    
}

