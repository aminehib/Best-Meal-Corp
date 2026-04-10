document.addEventListener("DOMContentLoaded", function () {
    function trouverBlocDuChamp(champ) {
        let bloc = null;

        if (!champ) {
            return null;
        }

        bloc = champ.closest(".form-group");

        if (!bloc) {
            bloc = champ.closest(".pantry-inline-form");
        }

        if (!bloc) {
            bloc = champ.closest(".meta-item");
        }

        if (!bloc) {
            bloc = champ.closest(".recipe-edit-form");
        }

        if (!bloc) {
            bloc = champ.closest(".admin-form");
        }

        if (!bloc) {
            bloc = champ.closest(".login-form");
        }

        if (!bloc) {
            bloc = champ.parentElement;
        }

        return bloc;
    }

    function enleverErreur(champ) {
        let bloc = null;
        let message = null;

        if (!champ) {
            return;
        }

        champ.classList.remove("field-error");
        champ.removeAttribute("aria-invalid");
        champ.style.borderColor = "";

        bloc = trouverBlocDuChamp(champ);

        if (bloc) {
            message = bloc.querySelector(".field-error-message");

            if (message) {
                message.remove();
            }
        }
    }

    function afficherErreur(champ, texte) {
        let bloc = null;
        let message = null;

        if (!champ) {
            return;
        }

        enleverErreur(champ);

        champ.classList.add("field-error");
        champ.setAttribute("aria-invalid", "true");
        champ.style.borderColor = "#b42318";

        bloc = trouverBlocDuChamp(champ);

        if (bloc) {
            message = document.createElement("p");
            message.className = "field-error-message";
            message.textContent = texte;
            bloc.appendChild(message);
        }
    }

    function viderLesErreursDuFormulaire(formulaire) {
        let messages = formulaire.querySelectorAll(".field-error-message");
        let champs = formulaire.querySelectorAll(".field-error");
        let i = 0;

        for (i = 0; i < messages.length; i = i + 1) {
            messages[i].remove();
        }

        for (i = 0; i < champs.length; i = i + 1) {
            champs[i].classList.remove("field-error");
            champs[i].removeAttribute("aria-invalid");
            champs[i].style.borderColor = "";
        }
    }

    function verifierChampVide(champ, texteErreur) {
        if (!champ) {
            return true;
        }

        if (champ.value.trim() === "") {
            afficherErreur(champ, texteErreur);
            return false;
        }

        enleverErreur(champ);
        return true;
    }

    function verifierNombreMinimum(champ, minimum, texteErreur) {
        let valeur = "";

        if (!champ) {
            return true;
        }

        valeur = champ.value.trim();

        if (valeur === "") {
            afficherErreur(champ, texteErreur);
            return false;
        }

        if (Number(valeur) < minimum) {
            afficherErreur(champ, texteErreur);
            return false;
        }

        enleverErreur(champ);
        return true;
    }

    function verifierSelect(champ, texteErreur) {
        if (!champ) {
            return true;
        }

        if (champ.selectedOptions.length === 0) {
            afficherErreur(champ, texteErreur);
            return false;
        }

        enleverErreur(champ);
        return true;
    }

    function focusPremierChampErreur(listeChamps) {
        let i = 0;

        for (i = 0; i < listeChamps.length; i = i + 1) {
            if (listeChamps[i] && listeChamps[i].classList.contains("field-error")) {
                listeChamps[i].focus();
                return;
            }
        }
    }

    document.addEventListener("input", function (event) {
        let champ = event.target;

        if (champ.matches("input, textarea")) {
            enleverErreur(champ);
        }
    });

    document.addEventListener("change", function (event) {
        let champ = event.target;

        if (champ.matches("select, input[type='file']")) {
            enleverErreur(champ);
        }
    });

    let formulaireConnexion = document.querySelector(".login-form");

    if (formulaireConnexion) {
        formulaireConnexion.addEventListener("submit", function (event) {
            let champUsername = formulaireConnexion.querySelector('input[name="username"]');
            let champPassword = formulaireConnexion.querySelector('input[name="password"]');
            let formulaireValide = true;

            viderLesErreursDuFormulaire(formulaireConnexion);

            if (!verifierChampVide(champUsername, "Veuillez entrer le username.")) {
                formulaireValide = false;
            }

            if (!verifierChampVide(champPassword, "Veuillez entrer le password.")) {
                formulaireValide = false;
            }

            if (formulaireValide === false) {
                event.preventDefault();
                focusPremierChampErreur([champUsername, champPassword]);
            }
        });
    }

    let formulaireRecette = document.querySelector(".recipe-global-form");

    if (formulaireRecette) {
        formulaireRecette.addEventListener("submit", function (event) {
            let champTitre = formulaireRecette.querySelector('input[name="title"]');
            let champDescription = formulaireRecette.querySelector('textarea[name="description"]');
            let champTempsPreparation = formulaireRecette.querySelector('input[name="preparation_time"]');
            let champTempsCuisson = formulaireRecette.querySelector('input[name="cooking_time"]');
            let champPersonnes = formulaireRecette.querySelector('input[name="servings"]');
            let champIngredients = formulaireRecette.querySelector('select[name="ingredients[]"]');
            let champTags = formulaireRecette.querySelector('select[name="tags[]"]');
            let champPreparation = formulaireRecette.querySelector('textarea[name="preparation"]');
            let formulaireValide = true;

            viderLesErreursDuFormulaire(formulaireRecette);

            if (!verifierChampVide(champTitre, "Veuillez entrer le titre.")) {
                formulaireValide = false;
            }

            if (!verifierChampVide(champDescription, "Veuillez entrer la description.")) {
                formulaireValide = false;
            }

            if (!verifierNombreMinimum(champTempsPreparation, 0, "Le temps de preparation doit etre superieur ou egal a 0.")) {
                formulaireValide = false;
            }

            if (!verifierNombreMinimum(champTempsCuisson, 0, "Le temps de cuisson doit etre superieur ou egal a 0.")) {
                formulaireValide = false;
            }

            if (!verifierNombreMinimum(champPersonnes, 1, "Le nombre de personnes doit etre superieur ou egal a 1.")) {
                formulaireValide = false;
            }

            if (!verifierSelect(champIngredients, "Veuillez choisir au moins un ingredient.")) {
                formulaireValide = false;
            }

            if (!verifierSelect(champTags, "Veuillez choisir au moins un tag.")) {
                formulaireValide = false;
            }

            if (!verifierChampVide(champPreparation, "Veuillez entrer la preparation.")) {
                formulaireValide = false;
            }

            if (formulaireValide === false) {
                event.preventDefault();
                focusPremierChampErreur([
                    champTitre,
                    champDescription,
                    champTempsPreparation,
                    champTempsCuisson,
                    champPersonnes,
                    champIngredients,
                    champTags,
                    champPreparation
                ]);
            }
        });
    }

    document.addEventListener("submit", function (event) {
        let formulaire = event.target;
        let champNom = null;

        if (formulaire.matches('form[action*="add_Ingredient"], form[action*="update_Ingredient"]')) {
            viderLesErreursDuFormulaire(formulaire);
            champNom = formulaire.querySelector('input[name="name"]');

            if (!verifierChampVide(champNom, "Veuillez entrer le nom de l'ingredient.")) {
                event.preventDefault();
                focusPremierChampErreur([champNom]);
            }
        }

        if (formulaire.matches('form[action*="add_Tag"], form[action*="update_Tag"]')) {
            viderLesErreursDuFormulaire(formulaire);
            champNom = formulaire.querySelector('input[name="name"]');

            if (!verifierChampVide(champNom, "Veuillez entrer le nom du tag.")) {
                event.preventDefault();
                focusPremierChampErreur([champNom]);
            }
        }
    });
});