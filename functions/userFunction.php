<?php
include "data.php";

//fonction de creation de gestionnaire 

function registerUser($nom, $email, $password, $phone, $role) {

    $admin = 1;
    // verifications des champs non vides
    if (empty($nom) || empty($email) || empty($password) || empty($phone) || empty($role)) {
        return "Tous les champs sont requis.";
    }

    // Validation du type d'utilisateur
    if (!in_array($role, ['gestionnaire'])) {
        return "Type d'utilisateur non valide.";
    }

    // Hashage du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Préparation de la requête d'insertion
        $query = $GLOBALS['data']->prepare("INSERT INTO users (name_user, email_user, phone_user, password_user, role) VALUES (:nom, :email, :phone, :password_user, :role)");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':password_user', $passwordHash);
        $query->bindParam(':role', $role);

        // Exécution de la requête
        $query->execute();
        return "Inscription réussie !";
        //retourner vers la connexion
    } catch (PDOException $e) {
        return "Erreur d'inscription : " . $e->getMessage();
    }
}

//fonction de connection user
function loginUser($email, $password){

    try{

        $query = $GLOBALS['data']->prepare("SELECT * FROM users WHERE email_user = :email");

        $query->bindParam(':email', $email);
        $query->execute();

        $results = $query->fetch();

        if($results && password_verify($password, $results['password_user'])){

        
            }


            if($results['role'] == "gestionnaire" || $results['role'] == "employe"){

                session_start();
                $_SESSION['is_logged_in'] = true;
                $_SESSION['id_user'] = $results['id_user'];
                $_SESSION['email_user'] = $results['email_user'];
                $_SESSION['name_user'] = $results['name_user'];
                $_SESSION['password_user'] = $results['password_user'];
                $_SESSION['is_admin'] = $results['is_admin'];
                $_SESSION['role'] = $results['role'];
                $_SESSION['phone_user'] = $results['phone_user'];

          
           return $results;
        }
    //}
        
    } catch (PDOException $e){

        return "Impossible de vous connecter " . $e->getMessage();
    }

}


//fonction de creation compte employé par le gestionnaire


function registerEmployee($nom, $email, $password, $phone, $role) {

    //$admin = 1;
    // verifications des champs non vides
    if (empty($nom) || empty($email) ||  empty($phone) || empty($role)) {
        return "Tous les champs sont requis.";
    }

    // Validation du type d'utilisateur
    if (!in_array($role, ['employe'])) {
        return "Type d'utilisateur non valide.";
    }

    // Hashage du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Préparation de la requête d'insertion
        $query = $GLOBALS['data']->prepare("INSERT INTO users (name_user, email_user, phone_user, password_user, role) VALUES (:nom, :email, :phone, :password_user, :role)");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':password_user', $passwordHash);
        $query->bindParam(':role', $role);

        // Exécution de la requête
        $query->execute();
        return "Inscription réussie !";
        //retourner vers la connexion
    } catch (PDOException $e) {
        return "Erreur d'inscription : " . $e->getMessage();
    }
}




//function  de verification de la connexion user
function checkLogin(){
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header('Location: index.php');  // Rediriger vers la page de connexion
    exit;  // Arrêter l'exécution des scripts suivants
}
}

//function de modification user



?>