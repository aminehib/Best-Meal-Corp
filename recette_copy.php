<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recette Admin - Livret de Recettes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css">
    <link rel="stylesheet" href="/projet-recette/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content admin-recipe-page">
    <section class="recette-page">
        <div class="container">

            <div class="recette-top">
                <div class="recette-image admin-block clickable-image-block" id="image-trigger">
                    <img src="/projet-recette/images/pizza.jpg" alt="Pizza Maison" id="recipe-image">

                    <form action="/projet-recette/actions/modifier.php" method="POST" enctype="multipart/form-data" class="recipe-edit-form image-form is-hidden" data-form-id="image-form">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="image">

                        <label for="image" class="sr-only">Changer l'image</label>
                        <input type="file" id="image" name="image" accept="image/*" class="hidden-file-input">
                    </form>
                </div>

                <div class="recette-info">
                    <span class="page-subtitle">D&eacute;tail de la recette</span>

                    <div class="editable-header">
                        <h1>Pizza Maison</h1>
                        <a href="#" class="edit-inline-btn" data-target="title-form" title="Modifier le titre">✎</a>
                    </div>

                    <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form recipe-edit-hero is-hidden" data-form-id="title-form">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="title">
                        <input type="text" id="title" name="title" value="Pizza Maison" class="recipe-title-input">
                        <button type="submit" class="recipe-form-btn">Enregistrer</button>
                    </form>

                    <div class="editable-block">
                        <p class="recette-description">
                            Une pizza savoureuse pr&eacute;par&eacute;e avec des ingr&eacute;dients frais, une p&acirc;te croustillante
                            et une garniture riche en saveurs. Parfaite pour un repas convivial en famille.
                        </p>
                        <a href="#" class="edit-inline-btn" data-target="description-form" title="Modifier la description">✎</a>
                    </div>

                    <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form recipe-edit-hero is-hidden" data-form-id="description-form">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="description">
                        <textarea id="description" name="description" class="recipe-description-input">Une pizza savoureuse pr&eacute;par&eacute;e avec des ingr&eacute;dients frais, une p&acirc;te croustillante et une garniture riche en saveurs. Parfaite pour un repas convivial en famille.</textarea>
                        <button type="submit" class="recipe-form-btn">Enregistrer</button>
                    </form>

                    <div class="editable-section">
                        <div class="section-head">
                            <span class="section-edit-title">Informations</span>
                            <a href="#" class="edit-inline-btn" data-target="infos-form" title="Modifier les informations">✎</a>
                        </div>

                        <div class="recette-meta">
                            <div class="meta-item">
                                <span class="meta-label">Temps de pr&eacute;paration</span>
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

                        <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form recipe-meta-form is-hidden" data-form-id="infos-form">
                            <input type="hidden" name="recipe_id" value="1">
                            <input type="hidden" name="action_type" value="infos">

                            <div class="recette-meta">
                                <div class="meta-item">
                                    <label for="prep_time" class="meta-label">Temps de pr&eacute;paration</label>
                                    <input type="text" id="prep_time" name="prep_time" value="20 min" class="recipe-text-input">
                                </div>

                                <div class="meta-item">
                                    <label for="cook_time" class="meta-label">Temps de cuisson</label>
                                    <input type="text" id="cook_time" name="cook_time" value="25 min" class="recipe-text-input">
                                </div>

                                <div class="meta-item">
                                    <label for="servings" class="meta-label">Nombre de personnes</label>
                                    <input type="text" id="servings" name="servings" value="4 personnes" class="recipe-text-input">
                                </div>
                            </div>
                            <button type="submit" class="recipe-form-btn">Enregistrer</button>
                        </form>
                    </div>

                    <div class="editable-section">
                        <div class="section-head">
                            <span class="section-edit-title">Tags</span>
                            <a href="#" class="edit-inline-btn" data-target="tags-form" title="Modifier les tags">✎</a>
                        </div>

                        <div class="recette-tags">
                            <span>Plat</span>
                            <span>Fromage</span>
                            <span>Maison</span>
                        </div>

                        <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form recipe-tags-form is-hidden" data-form-id="tags-form">
                            <input type="hidden" name="recipe_id" value="1">
                            <input type="hidden" name="action_type" value="tags">

                            <select id="tag-select" name="tags[]" class="recipe-select" multiple>
                                <option value="plat" selected>Plat</option>
                                <option value="fromage" selected>Fromage</option>
                                <option value="maison" selected>Maison</option>
                            </select>
                            <button type="submit" class="recipe-form-btn">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="recette-content">
                <div class="ingredients-box">
                    <div class="section-head">
                        <h2>Ingr&eacute;dients</h2>
                        <a href="#" class="edit-inline-btn" data-target="ingredients-form" title="Modifier les ingr&eacute;dients">✎</a>
                    </div>

                    <ul>
                        <li>P&acirc;te &agrave; pizza</li>
                        <li>Sauce tomate</li>
                        <li>Fromage r&acirc;p&eacute;</li>
                        <li>Olives</li>
                        <li>Poivrons</li>
                        <li>Champignons</li>
                    </ul>

                    <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form recipe-content-form is-hidden" data-form-id="ingredients-form">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="ingredients">

                        <select id="ingredient-select" name="ingredients[]" class="recipe-select recipe-select-large" multiple>
                            <option value="pate-pizza" selected>P&acirc;te &agrave; pizza</option>
                            <option value="sauce-tomate" selected>Sauce tomate</option>
                            <option value="fromage-rape" selected>Fromage r&acirc;p&eacute;</option>
                            <option value="olives" selected>Olives</option>
                            <option value="poivrons" selected>Poivrons</option>
                            <option value="champignons" selected>Champignons</option>
                        </select>
                        <button type="submit" class="recipe-form-btn">Enregistrer</button>
                    </form>
                </div>

                <div class="preparation-box">
                    <div class="section-head">
                        <h2>Pr&eacute;paration</h2>
                        <a href="#" class="edit-inline-btn" data-target="preparation-form" title="Modifier la pr&eacute;paration">✎</a>
                    </div>

                    <p>
                        &Eacute;talez la p&acirc;te &agrave; pizza sur une plaque. Ajoutez la sauce tomate, puis r&eacute;partissez
                        le fromage et les autres ingr&eacute;dients. Enfournez pendant environ 20 minutes dans
                        un four bien chaud jusqu'&agrave; obtenir une belle cuisson dor&eacute;e.
                    </p>

                    <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form recipe-content-form is-hidden" data-form-id="preparation-form">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="preparation">

                        <textarea id="preparation" name="preparation" class="recipe-textarea">&Eacute;talez la p&acirc;te &agrave; pizza sur une plaque. Ajoutez la sauce tomate, puis r&eacute;partissez le fromage et les autres ingr&eacute;dients. Enfournez pendant environ 20 minutes dans un four bien chaud jusqu'&agrave; obtenir une belle cuisson dor&eacute;e.</textarea>
                        <button type="submit" class="recipe-form-btn">Enregistrer</button>
                    </form>
                </div>
            </div>

            <div class="recette-actions">
                <a href="/projet-recette/recettes.php" class="btn btn-secondary">Retour aux recettes</a>
            </div>

        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script>
$(document).ready(function() {
    $('#ingredient-select').selectize({
        placeholder: 'Choisir un ou plusieurs ingrédients',
        plugins: ['remove_button']
    });

    $('#tag-select').selectize({
        placeholder: 'Choisir un ou plusieurs tags',
        plugins: ['remove_button']
    });

    document.querySelectorAll('[data-target]').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const formId = button.getAttribute('data-target');
            const form = document.querySelector('[data-form-id="' + formId + '"]');

            if (!form) return;

            if (formId === 'image-form') {
                const fileInput = form.querySelector('input[type="file"]');
                if (fileInput) {
                    fileInput.click();
                }
                return;
            }

            form.classList.toggle('is-hidden');
            button.classList.toggle('editing');
            button.textContent = form.classList.contains('is-hidden') ? '✎' : '✕';
        });
    });

    const imageTrigger = document.getElementById('image-trigger');
    const imageInput = document.getElementById('image');

    if (imageTrigger && imageInput) {
        imageTrigger.addEventListener('click', function(e) {
            if (e.target.closest('.edit-zone-btn')) return;
            imageInput.click();
        });
    }
});
</script>

</body>
</html>
