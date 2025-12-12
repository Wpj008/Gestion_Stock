function verifierChamps() {
    const nom = document.getElementById('nom').value;
    const nomErreur = document.getElementById('nomErreur');
    const regex = /^[A-Za-z]+$/; // Autorise uniquement les lettres non accentuées

    // Réinitialiser le message d'erreur
    nomErreur.textContent = '';

    if (!regex.test(nom)) {
        nomErreur.textContent = "Le nom ne doit contenir que des lettres non accentuées (A-Z, a-z).";
        return false; // Empêche la soumission du formulaire
    }

    return true;
}

// Vérification du mot de passe
function verificationPassword() {

    const password = document.querySelector("#password_3").value;
    const passwordError = document.querySelector("#passwordEror");
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; 

    passwordError.textContent = "";

    if(!regex.test(password)) {

        passwordError.textContent = "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial (@$!%*?&).";

        return false;
    }

    return true;
}
