document.addEventListener('DOMContentLoaded', function() {
    function clearErrors(form) {
        form.querySelectorAll('.input-error').forEach(function(field) {
            field.classList.remove('input-error');
        });

        form.querySelectorAll('.field-error').forEach(function(message) {
            message.remove();
        });
    }

    function showError(field, message) {
        if (!field) {
            return;
        }

        field.classList.add('input-error');

        var error = document.createElement('p');
        error.className = 'field-error';
        error.textContent = message;

        field.insertAdjacentElement('afterend', error);
    }

    function isEmpty(field) {
        if (!field) {
            return true;
        }

        if (field.tagName === 'SELECT') {
            return field.selectedOptions.length === 0;
        }

        return field.value.trim() === '';
    }

    function hasMinLength(field, length) {
        return field && field.value.trim().length >= length;
    }

    function isPositiveNumber(field) {
        return field && Number(field.value) > 0;
    }

    function validateLoginForm(form) {
        var username = form.querySelector('[name="username"]');
        var password = form.querySelector('[name="password"]');
        var valid = true;

        if (!hasMinLength(username, 3)) {
            showError(username, 'Le username doit contenir au moins 3 caracteres.');
            valid = false;
        }

        if (!hasMinLength(password, 4)) {
            showError(password, 'Le mot de passe doit contenir au moins 4 caracteres.');
            valid = false;
        }

        return valid;
    }

    function validateAdminForm(form) {
        var title = form.querySelector('[name="title"]');
        var description = form.querySelector('[name="description"]');
        var preparationTime = form.querySelector('[name="preparation_time"]');
        var cookingTime = form.querySelector('[name="cooking_time"]');
        var servings = form.querySelector('[name="servings"]');
        var image = form.querySelector('[name="img"]');
        var ingredients = form.querySelector('[name="ingredients[]"]');
        var tags = form.querySelector('[name="tags[]"]');
        var valid = true;

        if (!hasMinLength(title, 3)) {
            showError(title, 'Le titre doit contenir au moins 3 caracteres.');
            valid = false;
        }

        if (!hasMinLength(description, 10)) {
            showError(description, 'La description doit contenir au moins 10 caracteres.');
            valid = false;
        }

        [preparationTime, cookingTime, servings].forEach(function(field) {
            if (!isPositiveNumber(field)) {
                showError(field, 'La valeur doit etre superieure a 0.');
                valid = false;
            }
        });

        if (image && image.files.length === 0) {
            showError(image, 'Veuillez choisir une image.');
            valid = false;
        } else if (image && image.files.length > 0 && !image.files[0].type.startsWith('image/')) {
            showError(image, 'Le fichier doit etre une image.');
            valid = false;
        }

        if (isEmpty(ingredients)) {
            showError(ingredients, 'Choisissez au moins un ingredient.');
            valid = false;
        }

        if (isEmpty(tags)) {
            showError(tags, 'Choisissez au moins un tag.');
            valid = false;
        }

        return valid;
    }

    function validateSearchForm(form) {
        var fields = form.querySelectorAll('input, select');
        var hasValue = Array.from(fields).some(function(field) {
            return !isEmpty(field);
        });

        if (!hasValue) {
            var firstField = form.querySelector('input, select');
            showError(firstField, 'Remplissez au moins un critere de recherche.');
            return false;
        }

        return true;
    }

    document.querySelectorAll('form').forEach(function(form) {
        form.setAttribute('novalidate', 'novalidate');

        form.addEventListener('submit', function(event) {
            clearErrors(form);
            var valid = form.classList.contains('login-form')
                ? validateLoginForm(form)
                : form.classList.contains('admin-form')
                    ? validateAdminForm(form)
                    : form.classList.contains('search-form')
                        ? validateSearchForm(form)
                        : true;

            if (!valid) {
                event.preventDefault();
            }
        });
    });
});
