<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche - Livret de Recettes</title>
    <link rel="stylesheet" href="/projet-recette/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content">
    <section class="recherche-page">
        <div class="container">

            <div class="page-title">
                <span class="page-subtitle">Recherche avancée</span>
                <h1>Trouvez votre recette</h1>
                <p>
                    Recherchez une recette par nom, ingrédient ou tag pour trouver
                    facilement le plat qui vous convient.
                </p>
            </div>

            <div class="search-form-box">
                <form action="/projet-recette/recherche.php" method="GET" class="search-form">
                    <div class="form-group">
                        <label for="nom">Nom de la recette</label>
                        <input type="text" id="nom" name="nom" placeholder="Ex : Pizza, Salade, Gâteau...">
                    </div>

                    <div class="form-group">
                        <label for="ingredient">Ingrédient</label>
                        <input type="text" id="ingredient" name="ingredient" placeholder="Ex : tomate, fromage, chocolat...">
                    </div>

                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <input type="text" id="tag" name="tag" placeholder="Ex : dessert, léger, au four...">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </div>

            <div class="results-box">
                <h2>Résultats</h2>

                <div class="recettes-list">

                    <div class="recepie">
                        <img src="/projet-recette/images/pizza.jpg" alt="Pizza Maison">
                        <h2>Pizza Maison</h2>
                        <p>Une pizza savoureuse préparée avec des ingrédients frais et une pâte croustillante.</p>
                        <a href="/projet-recette/recette.php" class="btn btn-primary">Voir la recette</a>
                    </div>

                    <div class="recepie">
                        <img src="/projet-recette/images/salade.jpg" alt="Salade Fraîche">
                        <h2>Salade Fraîche</h2>
                        <p>Une salade légère et colorée, idéale pour un repas sain, rapide et rafraîchissant.</p>
                        <a href="/projet-recette/recette.php" class="btn btn-primary">Voir la recette</a>
                    </div>

                    <div class="recepie">
                        <img src="/projet-recette/images/gateau-chocolat.jpg" alt="Gâteau au Chocolat">
                        <h2>Gâteau au Chocolat</h2>
                        <p>Un dessert moelleux et gourmand, parfait pour les amateurs de chocolat.</p>
                        <a href="/projet-recette/recette.php" class="btn btn-primary">Voir la recette</a>
                    </div>

                </div>
            </div>

        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<script src="/projet-recette/js/validation.js"></script>

</body>
</html>
