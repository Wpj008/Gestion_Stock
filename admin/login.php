<?php 
session_start();

include "../data.php";
//include "../header.php";
//test accès à la bdd 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    

    $email = $_POST['username'];
    $password = $_POST['password'];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = $data->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    $admin = $query->fetch();

    //echo (password_verify($passwordHash, $admin['mot_de_passe']));
     if ($admin && password_verify($password, $admin['mot_de_passe'])) {
        //echo "AA";
         session_start();
        
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['is_admin'] = $admin['is_admin'];
    
        if ($admin['is_admin'] == 1) {
            
            header('Location: admin/dashboard.php');
        } else {
            header('Location: ../index.php');
        }
    } else {
        echo "Identifiants incorrects";
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
        <h1>Espace Admin</h1>
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
            
        </form>
    </div>
</body>
</html>

<?php
//include "footer.php";
?>