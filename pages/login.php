<?php session_start(); 

if(isset($_SESSION["login"])){ // Si l'utilisateur est déjà connecté et qu'il force à rentrer dans la page admin, on le redirige vers la page d'accueil
    header("Location:/ProjetWeb/pages/index.php");// Redirection vers la page d'accueil
    exit();
}


require_once __DIR__."/../Autoload.php";
require_once __DIR__."/includes/login.php";
?>

    <?php
    if(isset($_GET["error"])){// Si une erreur est passée en paramètre, on la stocke dans une variable JavaScript pour l'afficher dans le formulaire de connexion
        ?>
        <script>var erreur = "<?= urldecode($_GET["error"])?>" </script> // Variable JavaScript contenant le message d'erreur à afficher dans le formulaire de connexion
        <script src ="js/form.js"></script>
        <?php
        unset($_GET["error"]);// On supprime l'erreur de l'URL pour éviter de l'afficher à nouveau si l'utilisateur rafraîchit la page
    }











