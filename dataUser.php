<?php 
session_start();
include "data.php";
include "functions/userFunction.php";
include "header.php";

$cheklog = checkLogin();//verifie la connexion

$idUser = $_SESSION['id_user'];
$name = $_SESSION['name_user'];
$email = $_SESSION['email_user'];
$phone = $_SESSION['phone_user'];
$role = $_SESSION['role'];


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="css/dataUser.css">
</head>
<body>

<div class="container">

    <h2 class="section-title">Profil Utilisateur</h2>

    <div class="profile-card">

        <div class="profile-header">
            <div>
                <h3><?= $name; ?></h3>
                <p class="email"><?= $email; ?></p>
            </div>
            <a class="btn edit-btn" href="update_password.php">Modifier Mon Mot de Passe</a>
        </div>

        <div class="profile-section">
            <h4>Informations personnelles</h4>

            <div class="profile-col">
                <div class="profile-col">
                    <label>Nom</label>
                    <input type="text" value="<?= $name; ?>">
                </div>
                <div class="profile-col">
                    <label>Téléphone</label>
                    <input type="text" value="<?= $phone; ?>">
                </div>
            </div>

            <div class="profile-col">
                <div class="profile-col">
                    <label>Email</label>
                    <input type="text" value="<?= $email; ?>">
                </div>
                <div class="profile-col">
                    <label>Poste</label>
                    <input type="text" value="<?= $role; ?>">
                </div>
            </div>

           

        </div>

        

        <button class="btn save-btn">Enregistrer</button>
        <button class="btn red-btn">Modifier Mot de passe</button>
    </div>

</div>

</body>
</html>
