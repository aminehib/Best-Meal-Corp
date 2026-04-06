
document.addEventListener("DOMContentLoaded", function () {
    if (typeof erreur !== "undefined" && erreur) {

        // créer le bloc d'erreur
        const errorBox = document.createElement("div");
        errorBox.className = "alert-error";

        errorBox.innerHTML = `
            <span class="alert-icon">⚠️</span>
            <span class="alert-message">${erreur}</span>
            <button class="alert-close">X</button>
        `;

        // ajouter en haut de la page
        const main = document.querySelector(".main-content");
        if (main) main.prepend(errorBox);
        else document.body.prepend(errorBox);

        // bouton fermer
        errorBox.querySelector(".alert-close").addEventListener("click", () => {
            errorBox.remove();
        });

        setTimeout(() => {
            if(errorBox) errorBox.remove();
        }, 3000); 
    }
});