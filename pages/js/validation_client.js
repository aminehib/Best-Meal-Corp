document.addEventListener("DOMContentLoaded", function () {
    function erreur(champ, message) {
        alert(message);
        if (champ) {
            champ.focus();
        }
        return false;
    }

    const loginForm = document.querySelector(".login-form");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            const username = loginForm.querySelector('input[name="username"]');
            const password = loginForm.querySelector('input[name="password"]');

            if (username.value.trim() === "") {
                e.preventDefault();
                erreur(username, "Veuillez entrer le username.");
                return;
            }

            if (password.value.trim() === "") {
                e.preventDefault();
                erreur(password, "Veuillez entrer le password.");
            }
        });
    }

    const recipeForm = document.querySelector(".recipe-global-form");
    if (recipeForm) {
        recipeForm.addEventListener("submit", function (e) {
            const title = recipeForm.querySelector('input[name="title"]');
            const description = recipeForm.querySelector('textarea[name="description"]');
            const preparationTime = recipeForm.querySelector('input[name="preparation_time"]');
            const cookingTime = recipeForm.querySelector('input[name="cooking_time"]');
            const servings = recipeForm.querySelector('input[name="servings"]');
            const ingredients = recipeForm.querySelector('select[name="ingredients[]"]');
            const tags = recipeForm.querySelector('select[name="tags[]"]');
            const preparation = recipeForm.querySelector('textarea[name="preparation"]');

            if (title && title.value.trim() === "") {
                e.preventDefault();
                erreur(title, "Veuillez entrer le titre.");
                return;
            }

            if (description && description.value.trim() === "") {
                e.preventDefault();
                erreur(description, "Veuillez entrer la description.");
                return;
            }

            if (preparationTime && (preparationTime.value.trim() === "" || Number(preparationTime.value) < 0)) {
                e.preventDefault();
                erreur(preparationTime, "Le temps de preparation doit etre superieur ou egal a 0.");
                return;
            }

            if (cookingTime && (cookingTime.value.trim() === "" || Number(cookingTime.value) < 0)) {
                e.preventDefault();
                erreur(cookingTime, "Le temps de cuisson doit etre superieur ou egal a 0.");
                return;
            }

            if (servings && (servings.value.trim() === "" || Number(servings.value) < 1)) {
                e.preventDefault();
                erreur(servings, "Le nombre de personnes doit etre superieur ou egal a 1.");
                return;
            }

            if (ingredients && ingredients.selectedOptions.length === 0) {
                e.preventDefault();
                erreur(ingredients, "Veuillez choisir au moins un ingredient.");
                return;
            }

            if (tags && tags.selectedOptions.length === 0) {
                e.preventDefault();
                erreur(tags, "Veuillez choisir au moins un tag.");
                return;
            }

            if (preparation && preparation.value.trim() === "") {
                e.preventDefault();
                erreur(preparation, "Veuillez entrer la preparation.");
            }
        });
    }

    document.addEventListener("submit", function (e) {
        const form = e.target;

        if (form.matches('form[action*="add_Ingredient"], form[action*="update_Ingredient"]')) {
            const name = form.querySelector('input[name="name"]');

            if (name && name.value.trim() === "") {
                e.preventDefault();
                erreur(name, "Veuillez entrer le nom de l'ingredient.");
            }
        }

        if (form.matches('form[action*="add_Tag"], form[action*="update_Tag"]')) {
            const name = form.querySelector('input[name="name"]');

            if (name && name.value.trim() === "") {
                e.preventDefault();
                erreur(name, "Veuillez entrer le nom du tag.");
            }
        }
    });
});

