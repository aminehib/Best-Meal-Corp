<?php session_start(); 

if(isset($_SESSION["login"])){ // Si l'utilisateur est déjà connecté et qu'il force à rentrer dans la page admin, on le redirige vers la page d'accueil
    header("Location:/ProjetWeb/pages/index.php");// Redirection vers la page d'accueil
    exit();
}


require_once __DIR__."/../Autoload.php";
require_once __DIR__."/includes/login.php";
?>

    <?php
    if(isset($_SESSION["erreur"])){// Si une erreur est passée en paramètre, on la stocke dans une variable JavaScript pour l'afficher dans le formulaire de connexion
        ?>
        <script>var erreur = "<?= $_SESSION["erreur"]?>" </script> // Variable JavaScript contenant le message d'erreur à afficher dans le formulaire de connexion
        <script src ="js/validation.js"></script>
        <?php
        unset($_SESSION["erreur"]);// On supprime l'erreur de la session pour éviter de l'afficher à nouveau si l'utilisateur rafraîchit la page
    }



    ?>
    <script src = "js/validation_client.js"></script>








