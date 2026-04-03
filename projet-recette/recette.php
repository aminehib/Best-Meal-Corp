<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de la recette - Livret de Recettes</title>
    <link rel="stylesheet" href="/projet-recette/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content">
    <section class="recette-page">
        <div class="container">

            <div class="recette-top">
                <div class="recette-image">
                    <img src="/projet-recette/images/pizza.jpg" alt="Pizza Maison">
                </div>

                <div class="recette-info">
                    <span class="page-subtitle">Détail de la recette</span>
                    <h1>Pizza Maison</h1>
                    <p class="recette-description">
                        Une pizza savoureuse préparée avec des ingrédients frais, une pâte croustillante
                        et une garniture riche en saveurs. Parfaite pour un repas convivial en famille.
                    </p>
                      <div class="recette-meta">
        <div class="meta-item">
            <span class="meta-label">Temps de préparation</span>
            <span class="meta-value">20 min</span>
        </div>

        <div class="meta-item">
            <span class="meta-label">Temps de cuisson</span>
            <span class="meta-value">25 min</span>
        </div>

        <div class="meta-item">
            <span class="meta-label">Nombre de personnes</span>
            <span class="meta-value">4 personnes</span>
        </div>
    </div>

                    <div class="recette-tags">
                        <span>Plat</span>
                        <span>Fromage</span>
                        <span>Maison</span>
                    </div>
                </div>
            </div>

            <div class="recette-content">
                <div class="ingredients-box">
                    <h2>Ingrédients</h2>
                    <ul>
                        <li>Pâte à pizza</li>
                        <li>Sauce tomate</li>
                        <li>Fromage râpé</li>
                        <li>Olives</li>
                        <li>Poivrons</li>
                        <li>Champignons</li>
                    </ul>
                </div>

                <div class="preparation-box">
                    <h2>Préparation</h2>
                    <p>
                        Étalez la pâte à pizza sur une plaque. Ajoutez la sauce tomate, puis répartissez
                        le fromage et les autres ingrédients. Enfournez pendant environ 20 minutes dans
                        un four bien chaud jusqu’à obtenir une belle cuisson dorée.
                    </p>
                </div>
            </div>

            <div class="recette-actions">
                <a href="/projet-recette/recettes.php" class="btn btn-secondary">Retour aux recettes</a>
            </div>

        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>