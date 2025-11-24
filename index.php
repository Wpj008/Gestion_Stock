<?php
include "data.php";
include "functions/userFunction.php";
include "header.php";

$errormessage = "";



if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

$email = $_POST['username'];

$password = htmlspecialchars($_POST['password']);


   
        $login = loginUser($email, $password);

        if ($login) {

            $role = $_SESSION['role'];

            if ($password == '0000'){

                $query = $GLOBALS['data']->prepare("SELECT * FROM users WHERE email_user = :email");
                    $query->bindParam(':email', $email);
                    $query->execute();
                        $values = $query->fetch();

                        $_SESSION['id_user'] = $values['id_user'];

                        header('Location: update_password.php');
                        exit();
            
            
             } else if ($role == "gestionnaire"){
               
            header('Location: admin/login.php');
            exit;

        } else{

            header('Location: home.php');
        }
        
    }else {
        $errormessage = "Email ou mot de passe incorrect.";
        }

 


}
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion de Stock</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="login-container">
        <h1>Gestion de Stock</h1>
        <h2>Connexion</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="username">Email:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>

           
            <p id="errormessage" style="color: red;"><?= $errormessage; ?></p>
            
            <button type="submit" name="submit">Connexion</button>
            <p class="signup">Pas encore de compte ? <a href="account_creation.php">Inscrivez-vous</a></p>
        </form>
    </div>

    <?php include "footer.php";?>
</body>
</html>
