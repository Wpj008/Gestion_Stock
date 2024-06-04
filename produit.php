<?php 
session_start();
include "data.php";
include "header.php";
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

        
  

  
        <p class="card-text"> Nom : <?php echo $_GET['nom'] ?> </p>
        <p class="card-text">Description : <?php echo $_GET['description'] ?> </p>
        <p class="card-text"> Quantité : <?php echo $_GET['quantite'] ?> </p>
        <p class="card-text"> Prix : <?php echo $_GET['prix'] ?> </p>
     
        
               
            </div>

             
        </div>
        
    </main>

    
</body>
</html>

<?php
include "footer.php";
?>
      