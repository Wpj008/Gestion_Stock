<?php
session_start();
include "data.php";
include "header.php";

//Recuperation de l'Id utilisateur

$idUser = $_SESSION['id_user'];
$erreurMessage = '';
$successMessage = '';


//Recuperation des infos liées à l'Id utilisateur

$query = $data->prepare("SELECT * FROM utilisateurs WHERE  id = :id" );

$query->bindParam(':id', $idUser);
$query->execute();
$results = $query->fetch();



if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

    //Recuperation du mdp dans la bdd

    $password = $results['mot_de_passe'];


$password_1 = $_POST['password_1'];

//Comparaison du mdp etant dans bdd et celui saisi par l'user

if($password === $password_1  ){

$password_2 = $_POST['password_2'];

$password_3 = $_POST['password_3'];




if($password_3){


    $query = $data->prepare ("UPDATE utilisateurs SET mot_de_passe = :password_3 WHERE id = :id_user");

    $query->bindParam(':password_3', $password_3);
    $query->bindParam(':id_user', $idUser);

    $query->execute();

    if($query->execute()){

        $successMessage = "Votre mot de passe a été mis à jour avec succès";

    }

   // header('Location: accueil.php');

 }


} else{
       $erreurMessage = " votre mot de passe n'existe pas dans la base de données ";
}

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Changement de Mot de Passe</title>
<link rel="stylesheet" href="css/password.css">
<script src="js/password.js"></script>
</head>
<body >

<br><br><br><br><br><br><br><br>

<div class="formulaire">

<form action="" method="POST" onsubmit="return verifierMotsDePasse()">



<label for="password_1"> Ancien Mot de passe</label>

<input type="password" id="password_1" name="password_1"  required><br><br>

<label for="password_2"> Nouveau Mot de passe</label>

<input type="password" id="password_2" name="password_2"  required><br><br>

<p>confirmez le mot de passe</p>

<input type="password" id="password_3" name="password_3"  required><br><br>

<p id="erreurMotDePasse" style="color: red;"></p>

<p id="successMessage" style="color: green;"><?= $successMessage; ?></p>

<p id="erreurMessage" style="color: red;"><?= $erreurMessage; ?></p>


<button type="submit" name="submit">Enregistrer</button>


</form>

</div>


</body>
</html>



