<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livret de Recettes</title>
    <link rel="stylesheet" href="/projet-recette/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="container hero-container">
        <div class="hero-text">
            <span class="hero-subtitle">Bienvenue sur notre univers culinaire</span>
            <h1>Decouvrez des recettes savoureuses, simples et inspirantes</h1>
            <p>
                Explorez notre livret de recettes et trouvez des idees delicieuses
                pour vos repas quotidiens, vos desserts et vos moments en famille.
            </p>

            <div class="hero-buttons">
                <a href="recettes.php" class="btn btn-primary">Voir les recettes</a>
                <a href="mon_panier.php" class="btn btn-secondary">Mon panier</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="images/logo.png" alt="Cuisine et recettes">
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <div class="section-title">
            <h2>Pourquoi utiliser notre site ?</h2>
            <p>Un espace simple, pratique et agreable pour decouvrir la cuisine.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <h3>Recettes variees</h3>
                <p>Des plats, desserts et idees gourmandes pour tous les gouts.</p>
            </div>

            <div class="feature-card">
                <h3>Recherche rapide</h3>
                <p>Retrouvez facilement une recette selon son nom, ses ingredients ou ses tags.</p>
            </div>

            <div class="feature-card">
                <h3>Mon panier</h3>
                <p>Accedez rapidement a vos ingredients, leurs images et leurs tags dans un espace dedie.</p>
            </div>
        </div>
    </div>
</section>

<section class="discover">
    <div class="container discover-box">
        <h2>Pret a commencer ?</h2>
        <p>Consultez notre collection de recettes et trouvez votre prochain repas prefere.</p>
        <div class="hero-buttons">
            <a href="recettes.php" class="btn btn-primary">Explorer les recettes</a>
            <a href="mon_panier.php" class="btn btn-primary">Ouvrir mon panier</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
