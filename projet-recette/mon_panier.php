<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - Livret de Recettes</title>
    <link rel="stylesheet" href="/projet-recette/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content pantry-page">
    <section class="recettes-page">
        <div class="container">
            <div class="page-title">
                <span class="page-subtitle">Gestion des ingredients</span>
                <h1>Mon panier</h1>
                <p>Modifiez separement vos ingredients et vos tags dans deux espaces distincts.</p>
            </div>

            <div class="pantry-sections">
                <section class="pantry-section">
                    <div class="section-head">
                        <h2>Ingredients</h2>
                        <button type="button" class="pantry-add-btn" data-add-type="ingredient" title="Ajouter un ingredient">+</button>
                    </div>

                    <div class="pantry-list" id="pantry-ingredient-list">
                        <article class="pantry-row">
                            <div class="pantry-row-image pantry-image-trigger" id="pantry-image-trigger-1">
                                <img src="/projet-recette/images/salade.jpg" alt="Tomate">
                                <form action="/projet-recette/actions/modifier.php" method="POST" enctype="multipart/form-data" class="recipe-edit-form image-form is-hidden" data-form-id="pantry-image-form-1">
                                    <input type="hidden" name="ingredient_id" value="1">
                                    <input type="hidden" name="action_type" value="image">
                                    <label for="pantry-image-1" class="sr-only">Changer l'image</label>
                                    <input type="file" id="pantry-image-1" name="image" accept="image/*" class="hidden-file-input">
                                </form>
                            </div>

                            <div class="pantry-row-content">
                                <div class="editable-header">
                                    <h3>Tomate</h3>
                                    <a href="#" class="edit-inline-btn" data-target="pantry-name-form-1" title="Modifier le nom">✎</a>
                                </div>

                                <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="pantry-name-form-1">
                                    <input type="hidden" name="ingredient_id" value="1">
                                    <input type="hidden" name="action_type" value="name">
                                    <input type="text" name="name" value="Tomate" class="recipe-text-input">
                                    <button type="submit" class="recipe-form-btn">Enregistrer</button>
                                </form>
                            </div>
                        </article>

                        <article class="pantry-row">
                            <div class="pantry-row-image pantry-image-trigger" id="pantry-image-trigger-2">
                                <img src="/projet-recette/images/pizza.jpg" alt="Fromage">
                                <form action="/projet-recette/actions/modifier.php" method="POST" enctype="multipart/form-data" class="recipe-edit-form image-form is-hidden" data-form-id="pantry-image-form-2">
                                    <input type="hidden" name="ingredient_id" value="2">
                                    <input type="hidden" name="action_type" value="image">
                                    <label for="pantry-image-2" class="sr-only">Changer l'image</label>
                                    <input type="file" id="pantry-image-2" name="image" accept="image/*" class="hidden-file-input">
                                </form>
                            </div>

                            <div class="pantry-row-content">
                                <div class="editable-header">
                                    <h3>Fromage</h3>
                                    <a href="#" class="edit-inline-btn" data-target="pantry-name-form-2" title="Modifier le nom">✎</a>
                                </div>

                                <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="pantry-name-form-2">
                                    <input type="hidden" name="ingredient_id" value="2">
                                    <input type="hidden" name="action_type" value="name">
                                    <input type="text" name="name" value="Fromage" class="recipe-text-input">
                                    <button type="submit" class="recipe-form-btn">Enregistrer</button>
                                </form>
                            </div>
                        </article>

                        <article class="pantry-row">
                            <div class="pantry-row-image pantry-image-trigger" id="pantry-image-trigger-3">
                                <img src="/projet-recette/images/tarte.jpg" alt="Chocolat">
                                <form action="/projet-recette/actions/modifier.php" method="POST" enctype="multipart/form-data" class="recipe-edit-form image-form is-hidden" data-form-id="pantry-image-form-3">
                                    <input type="hidden" name="ingredient_id" value="3">
                                    <input type="hidden" name="action_type" value="image">
                                    <label for="pantry-image-3" class="sr-only">Changer l'image</label>
                                    <input type="file" id="pantry-image-3" name="image" accept="image/*" class="hidden-file-input">
                                </form>
                            </div>

                            <div class="pantry-row-content">
                                <div class="editable-header">
                                    <h3>Chocolat</h3>
                                    <a href="#" class="edit-inline-btn" data-target="pantry-name-form-3" title="Modifier le nom">✎</a>
                                </div>

                                <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="pantry-name-form-3">
                                    <input type="hidden" name="ingredient_id" value="3">
                                    <input type="hidden" name="action_type" value="name">
                                    <input type="text" name="name" value="Chocolat" class="recipe-text-input">
                                    <button type="submit" class="recipe-form-btn">Enregistrer</button>
                                </form>
                            </div>
                        </article>
                    </div>
                </section>

                <section class="pantry-section">
                    <div class="section-head">
                        <h2>Tags</h2>
                        <button type="button" class="pantry-add-btn" data-add-type="tag" title="Ajouter un tag">+</button>
                    </div>

                    <div class="pantry-tag-list" id="pantry-tag-list">
                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Legume</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-1" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-1">
                                <input type="hidden" name="tag_id" value="1">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Legume" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Dessert</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-2" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-2">
                                <input type="hidden" name="tag_id" value="2">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Dessert" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Leger</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-3" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-3">
                                <input type="hidden" name="tag_id" value="3">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Leger" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Vegetarien</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-4" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-4">
                                <input type="hidden" name="tag_id" value="4">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Vegetarien" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Au four</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-5" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-5">
                                <input type="hidden" name="tag_id" value="5">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Au four" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Rapide</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-6" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-6">
                                <input type="hidden" name="tag_id" value="6">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Rapide" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>
                    </div>
                </section>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function createIngredientRow(index) {
        const article = document.createElement('article');
        article.className = 'pantry-row pantry-row-new';
        article.innerHTML = `
            <div class="pantry-row-image pantry-image-trigger pantry-placeholder-box">
                <img src="/projet-recette/images/logo.png" alt="Nouvel ingredient">
                <label class="pantry-inline-label" for="new-ingredient-image-${index}">Image de l'ingredient</label>
                <input type="file" id="new-ingredient-image-${index}" name="new_ingredient_image[]" accept="image/*" class="recipe-text-input pantry-preview-input">
            </div>
            <div class="pantry-row-content">
                <div class="editable-header">
                    <h3>Nouvel ingredient</h3>
                </div>
                <div class="recipe-edit-form pantry-inline-form">
                    <label class="recipe-form-label" for="new-ingredient-name-${index}">Nom de l'ingredient</label>
                    <input type="text" id="new-ingredient-name-${index}" name="new_ingredient_name[]" class="recipe-text-input" placeholder="Ex : Tomate">
                </div>
            </div>
        `;
        return article;
    }

    function createTagRow(index) {
        const article = document.createElement('article');
        article.className = 'pantry-tag-row pantry-tag-add';
        article.innerHTML = `
            <div class="section-head">
                <h3>Nouveau tag</h3>
            </div>
            <div class="recipe-edit-form pantry-inline-form">
                <label class="recipe-form-label" for="new-tag-name-${index}">Nom du tag</label>
                <input type="text" id="new-tag-name-${index}" name="new_tag_name[]" class="recipe-text-input" placeholder="Ex : Dessert">
            </div>
        `;
        return article;
    }

    let ingredientIndex = document.querySelectorAll('.pantry-row').length + 1;
    let tagIndex = document.querySelectorAll('.pantry-tag-row').length + 1;

    document.addEventListener('click', function(e) {
        const editButton = e.target.closest('[data-target]');
        if (editButton) {
            e.preventDefault();
            const form = document.querySelector('[data-form-id="' + editButton.dataset.target + '"]');

            if (!form) {
                return;
            }

            form.classList.toggle('is-hidden');
            editButton.classList.toggle('editing');
            editButton.textContent = form.classList.contains('is-hidden') ? '✎' : '✕';
            return;
        }

        const addButton = e.target.closest('.pantry-add-btn');
        if (addButton) {
            const isIngredient = addButton.dataset.addType === 'ingredient';
            const list = document.getElementById(isIngredient ? 'pantry-ingredient-list' : 'pantry-tag-list');
            const newRow = isIngredient ? createIngredientRow(ingredientIndex++) : createTagRow(tagIndex++);

            list.appendChild(newRow);
            newRow.querySelector('input[type="text"]').focus();
            return;
        }

        const imageBox = e.target.closest('.pantry-image-trigger');
        if (imageBox && !e.target.closest('a, input, label, button')) {
            const input = imageBox.querySelector('input[type="file"]');
            if (input) {
                input.click();
            }
        }
    });

    document.addEventListener('change', function(e) {
        const input = e.target.closest('.pantry-preview-input');
        if (!input || !input.files || !input.files[0]) {
            return;
        }

        const preview = input.closest('.pantry-row-image').querySelector('img');
        if (preview) {
            preview.src = URL.createObjectURL(input.files[0]);
            preview.alt = input.files[0].name;
        }
    });
});
</script>

</body>
</html>
