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
            <div class="product-item">
                <img src="<?= $produit['image'] ?>" alt="">
                
                <h2> <?=  $produit['nom'] ?> </h2>
              <h2> <?= $produit['description'] ?> </h2>
              <h2> <?= $produit['quantite'] ?> </h2>
              <h2> <?= $produit['prix'] ." $"?> </h2>
                
              <a href="produit.php ? id_produit= <?= $produit['id'] ?> ">Voir produit</a>
           
              <br><br>
                <?php if($produit['quantite'] > 5){?>
               
               <p class="in-stock">En stock</p>
               
           <?php } else {
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

