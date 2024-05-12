<?php
include "data.php";


function inscrireUtilisateur($nom, $email, $password, $type) {
    // verifications des champs non vides
    if (empty($nom) || empty($email) || empty($password) || empty($type)) {
        return "Tous les champs sont requis.";
    }

    // Validation du type d'utilisateur
    if (!in_array($type, ['vendeur', 'acheteur'])) {
        return "Type d'utilisateur non valide.";
    }

    // Hashage du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Préparation de la requête d'insertion
        $query = $GLOBALS['data']->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, type) VALUES (:nom, :email, :mot_de_passe, :type)");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':email', $email);
        $query->bindParam(':mot_de_passe', $passwordHash);
        $query->bindParam(':type', $type);

        // Exécution de la requête
        $query->execute();
        return "Inscription réussie !";
    } catch (PDOException $e) {
        return "Erreur d'inscription : " . $e->getMessage();
    }
}


?>