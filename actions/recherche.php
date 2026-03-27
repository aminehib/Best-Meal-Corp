<?php
session_start();
$name = $_GET["nom"];

$ingredients = $_GET["ingredient"];

$tag = $_GET["tag"];

$db = new \gdb\RecepieDB();

$recepies = $db->get();//

$content = "";

foreach($recepies as $recepie){
    $content .= $recepie->getHTML();
}


header("Location:/ProjetWeb/pages/recettes.php?content=$content");
exit();












