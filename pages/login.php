<?php session_start(); 


require_once __DIR__."/../Autoload.php";
require_once __DIR__."/includes/login.php";
?>

    <?php
    if(isset($_GET["error"])){
        ?>
        <script>var erreur = "<?=htmlspecialchars($_GET["error"])?>" </script>
        <script src ="js/form.js"></script>
        <?php
        unset($_GET["error"]);
    }











