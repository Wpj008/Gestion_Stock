<?php
session_start();
include "data.php";
include "header.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header('Location: index.php');  // Rediriger vers la page de connexion
    exit;  // Arrêter l'exécution des scripts suivants
}

// Affichage de tous les produits se trouvant dans la bdd

$query = $data->prepare("SELECT * FROM produits WHERE etat_produit = 1" );

$query->execute();
  
$produits = $query->fetchAll();





?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link href="css/accueil.css" rel="stylesheet">
</head>
<body>

    
    <!-- Main Content -->
    <h1>Produits Disponibles</h1>

    <main class="product-grid-container">

        
        <div class="product-grid">
        <?php foreach($produits as $produit){?>
            <?php $produit['quantite'] ?>
            <div class="product-item">

            <?php if($produit['quantite'] > 5){?>

                <img src="<?= $produit['image'] ?>" alt="">
                
                <h2> Nom : <?=  $produit['nom'] ?> </h2>
              <h2> Description : <?= $produit['description'] ?> </h2>
              <h2> Quantite : <?= $produit['quantite'] ?> </h2>
              <h2> prix : <?= $produit['prix'] ." $"?> </h2>
                
              <a href="produit.php ? id_produit= <?= $produit['id'] ?> ">Voir produit</a>
           
              <br><br>
               
               
               <p class="in-stock">En stock</p>
               
           <?php } else {
                      $idProduit = $produit['id'] ;
                      

$queryproduit = $data->prepare ("UPDATE produits SET etat_produit = FALSE WHERE  id = :id_produit");

$queryproduit->bindParam(':id_produit', $idProduit);

$queryproduit->execute();
           }?>

           
               
                
            </div>

             
    <?php }?>
        </div>
        
    </main>

    
</body>
</html>


<?php
include "footer.php";
?>

