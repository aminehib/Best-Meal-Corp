document.addEventListener("DOMContentLoaded", function () {
    let formulaire = document.querySelector(".admin-form");
    let champTitre = document.getElementById("title");

    function enleverErreurTitre() {
        let bloc = null;
        let message = null;

        if (!champTitre) {
            return;
        }

        champTitre.classList.remove("field-error");
        champTitre.removeAttribute("aria-invalid");
        champTitre.style.borderColor = "";

        bloc = champTitre.closest(".form-group");

        if (bloc) {
            message = bloc.querySelector(".field-error-message");

            if (message) {
                message.remove();
            }
        }
    }

    function afficherErreurTitre(texte) {
        let bloc = null;
        let message = null;

        if (!champTitre) {
            return;
        }

        enleverErreurTitre();

        champTitre.classList.add("field-error");
        champTitre.setAttribute("aria-invalid", "true");
        champTitre.style.borderColor = "#b42318";

        bloc = champTitre.closest(".form-group");

        if (bloc) {
            message = document.createElement("p");
            message.className = "field-error-message";
            message.textContent = texte;
            bloc.appendChild(message);
        }
    }

    if (champTitre) {
        champTitre.addEventListener("input", function () {
            enleverErreurTitre();
        });
    }

    if (formulaire) {
        formulaire.addEventListener("submit", function (event) {
            if (!champTitre || champTitre.value.trim() !== "") {
                return;
            }

            event.preventDefault();
            afficherErreurTitre("Veuillez entrer le titre.");
            champTitre.focus();
        });
    }
});