<?php
include "data.php";
include "functions/userFunction.php";
include "header.php";

$errormessage = "";



if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

$email = $_POST['username'];

$password = htmlspecialchars($_POST['password_3']);


   
        $login = loginUser($email, $password);

        if ($login) {

            $role = $_SESSION['role'];
          
            $lengthPasasword = strlen($password);            

           if ($password == '12345678'){

                $query = $GLOBALS['data']->prepare("SELECT * FROM users WHERE email_user = :email");
                    $query->bindParam(':email', $email);
                    $query->execute();
                        $values = $query->fetch();

                        $_SESSION['id_user'] = $values['id_user'];

                        header('Location: update_password.php');
                        exit();
            
            
             } 
             
             if( $lengthPasasword < 8 ){

                $errormessage = "Taille de mot de passe insuffisante.";
              
   
               } else if ($role == "gestionnaire"){
               
            header('Location: admin/login.php');
            exit;

        }else{

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
    <script src="js/verification.js"></script>
</head>
<body>
    <div class="login-container">
        <h1>Gestion de Stock</h1>
        <h2>Connexion</h2>
        <form action="" method="POST" onsubmit = "return verificationPassword();">
            <div class="input-group">
                <label for="username">Email:</label>
                <input type="email" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password_3" name="password_3" required>
                <div id="passwordEror" class="error-message" style="color : red;"></div>
            </div>

           
            <p id="errormessage" style="color: red;"><?= $errormessage; ?></p>
            
            <button type="submit" name="submit">Connexion</button>
            <p class="signup">Pas encore de compte ? <a href="account_creation.php">Inscrivez-vous</a></p>
        </form>
    </div>

    <?php include "footer.php";?>
    
</body>
</html>
