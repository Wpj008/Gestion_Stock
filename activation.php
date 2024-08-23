<?php
session_start();
include "data.php";
include "header.php";

//Recuperation de l'id envoyé en parametre

$idProduit = $_GET['id_produit'];


if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {




//activation du produit dont l'id a été envoyé en parametre 
 

$queryproduit = $data->prepare ("UPDATE produits SET etat_produit = TRUE WHERE  id = :id_produit");

$queryproduit->bindParam(':id_produit', $idProduit);

$queryproduit->execute();

    
    //Redirection à la page vendeur.php
    
        header('Location: vendeur.php');
        
        
    
    }

?>

<div class= "form" >
<h2>Vous voulez sactiver ce produit ? </h2><br><br>

<div class="container">
<form method="POST" action="">

<button type="submit" name="submit">Activer le produit</button>

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