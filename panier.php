<?php 
session_start();
include "data.php";
include "header.php";

$id_user =$_SESSION['id_user'];

$querypanier  = $data->prepare("SELECT * FROM produits INNER JOIN  paniers ON produits.id = paniers.produit_id INNER JOIN utilisateurs ON utilisateurs.id = paniers.utilisateur_id WHERE utilisateur_id = :id ");

$querypanier->bindParam(':id', $id_user);

$querypanier->execute();

$panier = $querypanier->fetchAll(); ?>

<div class="conte">
<?php
if ($panier) {


    foreach ($panier as $paniers) {  ?>

        <div class="contener">
        
     <img src=" <?= $paniers['image'] ?>" alt="">
      
    <?php
        echo  $paniers['nom_produit'] ; 
        echo  $paniers['description'] ;
       
        echo  $paniers['quantite'];
     
        
        echo  "</div>";

    }?>

        </div>


        
<br><br>
<br><br>
<br><br>

<?php } else {
    echo "le panier est vide.";
}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="css/panier.css" rel="stylesheet">
</head>
<body>