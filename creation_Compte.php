<?php
session_start();
require 'fonction.php';
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

        // Récupération et nettoyage des données du formulaire
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $type = htmlspecialchars($_POST['type']);
    
        // Appel à la fonction d'inscription
        $result = inscrireUtilisateur($nom, $email, $password, $type);
        echo $result;
    }
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Gestion de Stock</title>
    <script src="js/verification.js"></script>
    <link href="css/Creation_Compte.css" rel="stylesheet"> 
</head>
<body>
    <div class="signup-container">
        <!-- <h1>Bienvenu à vous !</h1> -->
        <h2>Veuillez créer votre compte !</h2>
        <h3>Complétez vos identités</h3>
        <form method="POST" action="" onsubmit="return verifierChamps();">
            <fieldset>
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                    <div id="nomErreur" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="abcemail@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="fonction">Quelle est votre fonction ?</label>
                    <select name="type" id="type">
                        <option value="acheteur">Acheteur</option>
                        <option value="vendeur" selected>Vendeur</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Créer compte">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>


<?php
include "footer.php";
?>
