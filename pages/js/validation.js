document.addEventListener("DOMContentLoaded", function () {
    function creerBoiteErreur(messageErreur) {
        var boiteErreur = document.createElement("div");
        var iconeErreur = document.createElement("span");
        var texteErreur = document.createElement("span");
        var boutonFermer = document.createElement("button");

        boiteErreur.className = "alert-error";

        iconeErreur.className = "alert-icon";
        iconeErreur.textContent = "!";

        texteErreur.className = "alert-message";
        texteErreur.textContent = messageErreur;

        boutonFermer.className = "alert-close";
        boutonFermer.type = "button";
        boutonFermer.textContent = "X";

        boiteErreur.appendChild(iconeErreur);
        boiteErreur.appendChild(texteErreur);
        boiteErreur.appendChild(boutonFermer);

        return boiteErreur;
    }

    function trouverZoneAffichage() {
        var formulaireConnexion = document.querySelector(".login-form");
        var contenuPrincipal = document.querySelector(".main-content");

        if (formulaireConnexion) {
            return formulaireConnexion;
        }

        if (contenuPrincipal) {
            return contenuPrincipal;
        }

        return document.body;
    }

    function afficherErreur(messageErreur) {
        var boiteErreur;
        var zoneAffichage;
        var boutonFermer;

        boiteErreur = creerBoiteErreur(messageErreur);
        zoneAffichage = trouverZoneAffichage();
        zoneAffichage.prepend(boiteErreur);

        boutonFermer = boiteErreur.querySelector(".alert-close");
        boutonFermer.addEventListener("click", function () {
            boiteErreur.remove();
        });

        setTimeout(function () {
            boiteErreur.remove();
        }, 3000);
    }

    if (typeof erreur !== "undefined" && erreur) {
        afficherErreur(erreur);
    }
});
