<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - Livret de Recettes</title>
    <link rel="stylesheet" href="/ProjetWeb/pages/styles/style.css">
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
                <?php if(isset($_GET['erreur'])): ?>
                    <p style="color: red;"><?php echo htmlspecialchars(urldecode($_GET['erreur'])); ?></p>
                <?php endif; ?>
            </div>

            <div class="pantry-sections">
                <section class="pantry-section">
                    
                    <div class="section-head">
                        <h2>Ingredients</h2>
                        <?php if(isset($_SESSION["login"])): ?>
                            <button type="button" class="pantry-add-btn" data-add-type="ingredient" title="Ajouter un ingrédient">Ajouter</button>
                        <?php endif; ?>
                    </div>
                    <div class="pantry-list" id="pantry-ingredient-list">

                    <?php foreach($ingredients as $ingredient): ?>
                        <article class="pantry-row">
                            <div class="pantry-row-image pantry-image-trigger" id="<?= htmlspecialchars('pantry-image-trigger-' . $ingredient->id) ?>">
                                <img src="/ProjetWeb/pages/images/uploads/<?= htmlspecialchars($ingredient->image_url) ?>" alt="<?= htmlspecialchars($ingredient->name) ?>">
                                <?php if(isset($_SESSION["login"])): ?>
                                <form action="/ProjetWeb/actions/update_Ingredient.php" method="POST" enctype="multipart/form-data" class="recipe-edit-form image-form is-hidden" data-form-id="pantry-image-form-1">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($ingredient->id) ?>">
                                    <label for="pantry-image-<?= htmlspecialchars($ingredient->id) ?>" class="sr-only">Changer l'image</label>
                                    <input type="file" id="pantry-image-<?= htmlspecialchars($ingredient->id) ?>" name="img" accept="image/*" class="hidden-file-input">
                    
                                </form>
                                <?php endif; ?>
                            </div>

                            <div class="pantry-row-content">
                                <div class="editable-header">
                                    <h3><?= $ingredient->name ? htmlspecialchars($ingredient->name) :  "<span class=\"empty-placeholder\">Sans Nom</span>"  ?></h3>
                                    <?php if(isset($_SESSION["login"]) ): ?>
                                        <div class="button-group">
                                            <a href="#" class="edit-inline-btn" data-target="pantry-name-form-<?= htmlspecialchars($ingredient->id) ?>" title="Modifier le nom">✎</a>
                                            <a href="/ProjetWeb/actions/delete_Ingredient.php?id=<?= htmlspecialchars($ingredient->id) ?>" class="edit-inline-btn delete-inline-btn" title="Supprimer l'ingrédient" onclick="return confirm('Supprimer cet ingrédient ?');">🗑</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                        <?php if(isset($_SESSION["login"])): ?>
                                <form action="/ProjetWeb/actions/update_Ingredient.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="pantry-name-form-<?= htmlspecialchars($ingredient->id) ?>">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($ingredient->id) ?>">
                                    <input type="text" name="name" value="<?= htmlspecialchars($ingredient->name) ?>" class="recipe-text-input">
                                    <button type="submit" class="recipe-form-btn">Enregistrer</button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </article>


                        <?php endforeach ; ?>


                    </div>
                </section>

                <section class="pantry-section">
                     <div class="section-head">
                        <h2>Tags</h2>
                        <?php if(isset($_SESSION["login"])): ?>
                            <button type="button" class="pantry-add-btn" data-add-type="tag" title="Ajouter un tag">Ajouter</button>
                        <?php endif; ?>
                    </div>

                    <div class="pantry-tag-list" id="pantry-tag-list">


                        <?php foreach($tags as $tag): ?>
                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3><?= htmlspecialchars($tag->name) ?></h3>
                                <div class="button-group">
                                <?php if(isset($_SESSION["login"])): ?>
                                    <a href="#" class="edit-inline-btn" data-target="tag-form-<?= htmlspecialchars($tag->id) ?>" title="Modifier le tag">✎</a>
                                    <a href="/ProjetWeb/actions/delete_Tag.php?id=<?= htmlspecialchars($tag->id) ?>" class="edit-inline-btn delete-inline-btn" title="Supprimer le tag" onclick="return confirm('Supprimer ce tag ?');">🗑</a>
                                <?php endif; ?>
                                </div>
                            </div>
                            <?php if(isset($_SESSION["login"])): ?>
                            <form action="/ProjetWeb/actions/update_Tag.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-<?= htmlspecialchars($tag->id) ?>">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($tag->id) ?>">
                                <input type="text" name="name" value="<?= htmlspecialchars($tag->name) ?>" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                            <?php endif; ?>
                        </article>
                        <?php endforeach ; ?>


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
        article.className = 'new';
        article.innerHTML = `
        <form action="/ProjetWeb/actions/add_Ingredient.php" method="POST" enctype="multipart/form-data"  >
                <div class ="pantry-row-new pantry-row " >
                                    
            <div class="pantry-image-trigger pantry-placeholder-box">
                
                <img src="/projet-recette/images/logo.png" alt="Nouvel ingredient">
                <label class="pantry-inline-label" for="new-ingredient-image-${index}">Image de l'ingredient</label>
                <input type="file" id="new-ingredient-image-${index}" name="img" accept="image/*" class="recipe-text-input pantry-preview-input">
            </div>
            <div class="pantry-row-content">
                <div class="editable-header">
                    <h3>Nouvel ingredient</h3>
                    <!-- Bouton X pour supprimer un ingredient ajoute avec + -->
                    <button type="button" class="edit-inline-btn pantry-remove-btn" title="Supprimer">✕</button>
                </div>
                <div class="recipe-edit-form pantry-inline-form">
                    <label class="recipe-form-label" for="new-ingredient-name-${index}">Nom de l'ingredient</label>
                    <input type="text" id="new-ingredient-name-${index}" name="name" class="recipe-text-input" placeholder="Ex : Tomate">
                </div>

            </div>
             <button type="submit" class="recipe-form-btn">Enregistrer</button>
            </div>
            </form>
        `;
        return article;
    }

    function createTagRow(index) {
        const article = document.createElement('article');
        article.className = 'pantry-tag-row pantry-tag-add';
        article.innerHTML = `
            <form action="/ProjetWeb/actions/add_Tag.php" method="POST">
            <div class="section-head">
                <h3>Nouveau tag</h3>
                <!-- Bouton X pour supprimer un tag ajoute avec + -->
                <button type="button" class="edit-inline-btn pantry-remove-btn" title="Supprimer">✕</button>
            </div>
            <div class="recipe-edit-form pantry-inline-form">
                <label class="recipe-form-label" for="new-tag-name-${index}">Nom du tag</label>
                <input type="text" id="new-tag-name-${index}" name="name" class="recipe-text-input" placeholder="Ex : Dessert">
            </div>
            <button type="submit" class="recipe-form-btn">Enregistrer</button>
            </form>

        `;
        return article;
    }

    let ingredientIndex = document.querySelectorAll('.pantry-row').length + 1;
    let tagIndex = document.querySelectorAll('.pantry-tag-row').length + 1;

    document.addEventListener('click', function(e) {
        const removeButton = e.target.closest('.pantry-remove-btn');
        if (removeButton) {
            // Supprime uniquement les nouveaux blocs ajoutes avec le bouton +
            const row = removeButton.closest('article');
            if (row) {
                row.remove();
                // Re-enable the add button
                const isIngredient = row.querySelector('.pantry-row-new') !== null;
                const addBtn = document.querySelector(`.pantry-add-btn[data-add-type="${isIngredient ? 'ingredient' : 'tag'}"]`);
                if (addBtn) addBtn.disabled = false;
            }
            return;
        }

        const editButton = e.target.closest('[data-target]');
        if (editButton) {
            e.preventDefault();
            const form = document.querySelector('[data-form-id="' + editButton.dataset.target + '"]');

            if (!form) {
                return;
            }

            form.classList.toggle('is-hidden');
            editButton.classList.toggle('editing');
            // Change le bouton d'edition 
            editButton.textContent = form.classList.contains('is-hidden') ? '✎' : '✕';
            return;
        }

        const addButton = e.target.closest('.pantry-add-btn');
        if (addButton) {
            const isIngredient = addButton.dataset.addType === 'ingredient';
            const list = document.getElementById(isIngredient ? 'pantry-ingredient-list' : 'pantry-tag-list');
            // Check if there's already a new row
            const existingNew = list.querySelector('.pantry-row-new, .pantry-tag-add');
            if (existingNew) {
                return;
            }
            const newRow = isIngredient ? createIngredientRow(ingredientIndex++) : createTagRow(tagIndex++);
            list.prepend(newRow);
            newRow.querySelector('input[type="text"]').focus();
            // Disable the add button
            addButton.disabled = true;
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
 document.querySelectorAll('.hidden-file-input').forEach(function(input) {
        input.addEventListener('change', function() {
            if (input.files.length > 0) {
                input.form.submit();
            }
        });
    });

});
</script>

</body>
</html>