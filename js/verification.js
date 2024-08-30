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

function commandeChamps() {
    const commandes = document.getElementById('commandes').value;
    const commandeErreur = document.getElementById('commandeErreur');
    const regex = /^\d+$/; // Autorise uniquement les chiffres de 0 à 9

    // Réinitialiser le message d'erreur
    commandeErreur.textContent = '';

    // Vérifier si la valeur ne correspond pas à des chiffres
    if (!regex.test(commandes)) {
        commandeErreur.textContent = "Le champ ne peut contenir que des chiffres de 0 à 9.";
        return false; // Empêche la soumission du formulaire
    }

    return true; // Permet la soumission du formulaire
}