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

    
    <!-- Main Content -->
    <main class="product-grid-container">
        <h1>Produits Disponibles</h1>
        <div class="product-grid">
            <div class="product-item">
                <img src="img/fer1.jpg" alt="Produit 1">
                <h2>Nom du Produit 1</h2>
                <p>Prix: 10€</p>
                <p class="in-stock">En stock</p>
            </div>
            <div class="product-item">
                <img src="img/fer1.jpg" alt="Produit 2">
                <h2>Nom du Produit 2</h2>
                <p>Prix: 20€</p>
                <p class="in-stock">En stock</p>
            </div>

            <div class="product-item">
                <img src="img/fer1.jpg" alt="Produit 2">
                <h2>Nom du Produit 2</h2>
                <p>Prix: 20€</p>
                <p class="in-stock">En stock</p>
            </div>
            <div class="product-item">
                <img src="img/fer1.jpg" alt="Produit 2">
                <h2>Nom du Produit 4</h2>
                <p>Prix: 20€</p>
                <p class="in-stock">En stock</p>
            </div>
            

        </div>
    </main>

</body>
</html>


<?php
include "footer.php";
?>

