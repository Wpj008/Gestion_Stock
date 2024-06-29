<?php
session_start();
include "data.php";
include "header.php";

//Recuperation de l'id envoyé en parametre

$idProduit = $_GET['id_produit'];


if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

//Suppression du produit dont l'id a été envoyé en parametre 

    $query = $data->prepare(" DELETE FROM produits WHERE id =:id");
    
$query->bindParam(':id', $idProduit);

$query->execute();

    
    //Redirection à la page vendeur.php
    
        header('Location: vendeur.php');
        
        
    
    }

?>


<h2>Vous voulez supprimer ce produit ? </h2><br><br>

<div class="container">
<form method="POST" action="">

<button type="submit" name="submit">Supprimer definitivement</button>

</form>
</div>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
   
    <style>

.container button {

color: white;
background-color: red;
border: none;
padding: 0.5rem 1rem;
text-decoration: none;
border-radius: 4px;
display: inline-block;
margin-top: 1rem;
}

        </style>
</head>

<?php
include "footer.php";
?>