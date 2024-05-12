function verifierChamps() {
    var nom = document.getElementById('nom').value;
    var nomErreur = document.getElementById('nomErreur');
    var regex = /^[A-Za-z]+$/; // Autorise uniquement les lettres non accentuées

    // Réinitialiser le message d'erreur
    nomErreur.textContent = '';

    if (!regex.test(nom)) {
        nomErreur.textContent = "Le nom ne doit contenir que des lettres non accentuées (A-Z, a-z).";
        return false; // Empêche la soumission du formulaire
    }

    return true;
}

