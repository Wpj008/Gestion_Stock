<?php 
session_start();
include "data.php";
include "header.php";






    //recuperr l'id passé en parametre 
    $idProduit = $_GET['id_produit'];
    

    

    $query = $data->prepare("SELECT * FROM produits WHERE  id = :id" );

    $query->bindParam(':id', $idProduit);
    $query->execute();
    $results = $query->fetch();



if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

//Recuperation des informations du produit ayant l'id passé en parametre

$_SESSION['id_produit'] = $_GET['id_produit'];
$_SESSION['quantite'] = $results['quantite'];
$_SESSION['prix'] = $results['prix'];

//Redirection à la page commande.php

    header('Location: commande.php');

    

}



?>

        
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link href="css/accueil.css" rel="stylesheet">
</head>
<body>
        

<main class="product-grid-container">

        
<div class="product-grid">

    <div class="product-item">

        <img src="img/fer1.jpg" alt="Produit 1">

        
  

  
        <p class="card-text"> Nom : <?= $results['nom'] ?> </p>
        <p class="card-text">Description : <?= $results['description'] ?> </p>
        <p class="card-text"> Quantité : <?= $results['quantite'] ?> </p>
        <p class="card-text"> Prix : <?= $results['prix'] ?> </p>


     
        
               
            </div>

             
        </div>
        
    </main>

    <form method="POST" action="">

    <button type="submit" name="submit">Commander</button>

    </form>

  <br><br><br><br><br><br><br><br><br>
</body>
</html>

<?php
include "footer.php";
?>
      