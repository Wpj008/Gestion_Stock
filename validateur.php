<?php
session_start();
include "data.php";
include "header.php";

//Recuperation de l'id etat envoyé en parametre et id commande via la variablede session

$idCommande = $_SESSION['id_commande'] ;


$idEtat = $_GET['etat_id'];



if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {


//confirmation du produit dont l'id_commande a été envoyé en parametre 

if($idCommande){

$queryproduit = $data->prepare ("UPDATE commandes SET etat_id = 2 WHERE  id_commande = :id_commande");

$queryproduit->bindParam(':id_commande', $idCommande);

$queryproduit->execute();

    
    //Redirection à la page vendeur.php
    
        header('Location: validationCommande.php');
}  
     
    
    }


?>

<div class= "form" >
<h2>Vous voulez valider cette commande ? </h2><br><br>

<div class="container">
<form method="POST" action="">

<button type="submit" name="submit">Valider la commande</button>

</form>
</div>
</div>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title></title>
   
    <style>
        .form {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 400px;
    width: 100%;
    justify-content: center;
  }

.container button {

color: white;
background-color: blue;
border: none;
padding: 0.5rem 1rem;
text-decoration: none;
border-radius: 4px;

margin-top: 1rem;
}


        </style>
</head>

<?php
include "footer.php";
?>