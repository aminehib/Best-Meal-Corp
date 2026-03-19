<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livret de Recettes</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<header class="site-header">
    <div class="container header-container">
        <a href="/index.php" class="logo-link">
            <img src="/images/logo.png" alt="Logo du site" class="logo">
            <span class="site-title">Livret de Recettes</span>
        </a>

        <nav class="navbar">
            <ul class="nav-list">
                <li><a href="/index.php">Accueil</a></li>
                <li><a href="/recettes.php">Recettes</a></li>
                <li><a href="/recherche.php">Recherche</a></li>
                <li><a href="/admin/login.php">Admin</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="main-content">