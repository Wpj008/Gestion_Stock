<?php 
include "data.php";
include "header.php";
//test accès à la bdd 

/*$query = $data->prepare('SELECT * FROM utilisateurs');

$query->execute();
$results = $query->fetchAll(); */

/*foreach ($results as $res) {
  
        echo $res['nom']; 
    
    }*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion de Stock</title>
    <link rel="stylesheet" href="css/connexion.css">
</head>
<body>
    <div class="login-container">
        <h1>Gestion de Stock</h1>
        <h2>Connexion</h2>
        <form action="/path_to_your_authentication_script" method="POST">
            <div class="input-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Connexion</button>
            <p class="signup">Pas encore de compte ? <a href="creation_Compte.php">Inscrivez-vous</a></p>
        </form>
    </div>
</body>
</html>

<?php
include "footer.php";
?>