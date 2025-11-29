<?php
include __DIR__."/../data.php";

//fonction de creation de gestionnaire 

function registerUser($nom, $email, $password, $phone, $role) {

    $admin = 1;
    // verifications des champs non vides
    if (empty($nom) || empty($email) || empty($password) || empty($phone) || empty($role)) {
        echo "<p style='color:red;'>Tous les champs sont requis." ."</p>";
        return;
    }

    // Validation du type d'utilisateur
    if (!in_array($role, ['gestionnaire'])) {
        echo "<p style='color:red;'>Type d'utilisateur non valide." ."</p>";
        return;
    }

    // Hashage du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Préparation de la requête d'insertion
        $query = $GLOBALS['data']->prepare("INSERT INTO users (name_user, email_user, phone_user, password_user, role, is_admin) VALUES (:nom, :email, :phone, :password_user, :role, :is_admin)");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':password_user', $passwordHash);
        $query->bindParam(':role', $role);
        $query->bindParam(':is_admin', $admin);

        // Exécution de la requête
        $query->execute();
        echo "<p style='color:green;'>Inscription réussie !";
        //retourner vers la connexion
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erreur lors de l'inscription d'un gestionnaire : " . $e->getMessage()."</p>";
        return;
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
 
    } catch (PDOException $e){

        echo "<p style='color:red;'>Impossible de vous connecter " . $e->getMessage()."</p>";
        return;
    }

}


//fonction de creation compte employé par le gestionnaire


function registerEmployee($nom, $email, $password, $phone, $role) {

    //$admin = 1;
    // verifications des champs non vides
    if (empty($nom) || empty($email) ||  empty($phone) || empty($role)) {
        echo "<p style='color:red;'>Tous les champs sont requis." ."</p>";
        return;
    }

    // Validation du type d'utilisateur
    if (!in_array($role, ['employe'])) {
        echo "<p style='color:red;'>Type d'utilisateur non valide." ."</p>";
        return;
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
        echo "<p style='color:green;'>Inscription réussie !" ."</p>";
        //retourner vers la connexion
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erreur lors de l'inscription d'un employé : " . $e->getMessage()."</p>";
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

//function de afficher all user

function selectAllUser(){

    try{

         $query = $GLOBALS['data']->prepare("SELECT * FROM users");
            $query->execute();
            $users = $query->fetchAll();
            if($users){

                return $users;
            }
    }
    catch(PDOException $e){
        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos des utilisateurs " . $e->getMessage()."</p>";
        return false;
     }

}

//========================================================
//function qui affichera le nombre d'enregistrements dans bdd 

//function count users

function countUsers(){

    try{

         $query = $GLOBALS['data']->prepare("SELECT COUNT(*) AS total FROM users WHERE role = 'employe'");
            $query->execute();
            $result = $query->fetch();
            if($result){

                return $result;  

            }
    }
    catch(PDOException $e){
        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation du nombre des utilisateurs " . $e->getMessage()."</p>";
        return false;
     }

}


?>