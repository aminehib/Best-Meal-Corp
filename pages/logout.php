<?php
session_start();
session_destroy();// On détruit la session pour déconnecter l'utilisateur
$src = $_GET["src"];
header("Location:$src");// Redirection vers la page d'où l'utilisateur vient
exit();