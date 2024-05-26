<?php 

include "data.php";
include "header.php";


//test accès à la bdd 

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

    
    $email = $_POST['username'];
    
    $password = htmlspecialchars($_POST['password']);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    $query = $data->prepare("SELECT * FROM utilisateurs WHERE  mot_de_passe = :mot_de_passe AND email = :email  " );

    $query->bindParam(':mot_de_passe', $password);
       $query->bindParam(':email', $email);

        $query->execute();

  
     $results = $query->fetch();

        
        echo $results['email'] ;
        
        echo $results['mot_de_passe'];



    if($results){

        session_start();
        $_SESSION['username'] = $results['email'];
        $_SESSION['mot_de_passe'] = $results['mot_de_passe'];
        $_SESSION['is_admin'] = $results['is_admin'];
        $_SESSION['nom'] = $results['nom'];

        header('Location: accueil.php');

        exit();

    }
    else{
        echo "impossible de vous connecter";
    }


}


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
        <form action="" method="POST">
            <div class="input-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit">Connexion</button>
            <p class="signup">Pas encore de compte ? <a href="creation_Compte.php">Inscrivez-vous</a></p>
        </form>
    </div>
</body>
</html>

<?php
include "footer.php";
?>