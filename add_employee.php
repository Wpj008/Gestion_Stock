<?php 
session_start();
include "data.php";
include "functions/userFunction.php";
include "header.php";
include "functions/userFunction.php";

$checkLog = checkLogin();//check connection


$passeword = '0000';

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

    // Récupération et nettoyage des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    //$password = htmlspecialchars($_POST['password']);
    $passeword = '0000';
    $phone = htmlspecialchars($_POST['phone']);
    $role = htmlspecialchars($_POST['role']);

    // Appel à la fonction d'inscription
    $result = registerEmployee($nom, $email, $password, $phone, $role);
    echo $result;
}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Employé</title>
    <script src="js/verification.js"></script>
    <link href="css/account_creation.css" rel="stylesheet"> 
</head>
<body>
    <div class="signup-container">
        <!-- <h1>Bienvenu à vous !</h1> -->
        <h2>Veuillez créer le compte de l'employé !</h2>
        <h3>Complétez ses identités</h3>
        <form method="POST" action="" onsubmit="return verifierChamps();">
            <fieldset>
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                    <div id="nomErreur" class="error-message"></div>
                </div>
               
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="abcemail@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="phone">Télephone :</label>
                    <input type="number" id="phone" name="phone" placeholder="0 12 34 56 789" required>
                </div>
                <div class="form-group">
                    <label for="fonction">Fonction </label>
                    <select name="role" id="role">
                        <option value="employe">Employé</option>
                        <option value="administrateur">administrateur</option>
                        
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

include "footer.php"; ?>