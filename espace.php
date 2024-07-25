<?php 
session_start();
include "data.php";





$query = $data->prepare("SELECT COUNT(*) AS total FROM produits ");


$query->execute();

$valeur = $query->fetch();

//$query = $data->prepare("SELECT SUM (quantite) FROM produits ");


$query->execute();

$solde = $query->fetch();




?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock</title>
    <link rel="stylesheet" href="css/vendeur.css">
    <script src="js/script.js"></script>
    
</head>
<body>

<style>

body {

    font-family: Arial, sans-serif;
}

.user-info {

  
    padding: 20px;
    position: absolute;
top: 10px;
right: 10px;
}

.profile-button {
    background: none;
    border: none;
    cursor: pointer;
}
.profile-pic-large {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.profile-info {
    display: none;
 
    top: 70px;
    right: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.menu {
    margin-top: 20px;
}

.menu-content {
    display: flex;
    flex-direction: column;
}

.menu-content div {
    margin-bottom: 10px;
}

.menu-content a {
    text-decoration: none;
    color: #000;
    font-size: 16px;
}

.menu-content a:hover {
    text-decoration: underline;
}
</style>

    <div class="user-info">
        <button class="profile-button" onclick="toggleProfile()">
            <img src="https://img.icons8.com/?size=100&id=23293&format=png&color=000000" alt="Photo de profil" class="profile-pic-large">
        </button>

        <div class="profile-info" id="profile-info">
            <h2><?= $_SESSION['nom'] ?> <?= $_SESSION['type'] ?></h2>
            <p><b>Email :</b> <?= $_SESSION['username'] ?></p>

            
        
    

    <div class="menu">
        <div class="menu-content">
            
        <a href="#">Option 1</a>
        <a href="#">Option 1</a>
        <a href="#">Option 1</a>
        

        </div>
    </div>
    </div>

    </div>






<div class="sidebar">

<br><br><br><br>
        <div class="logo">PM-stock</div>


        
<ul>
        <li onclick="toggleDropdown(this)">Tableau de bord
            <div class="dropdown-content">
                <a href="#">Option 1</a>
                <a href="espace.php">Espace vendeur</a>
                <a href="deconnexion.php">Deconnexion</a>
            </div>
        </li>
        <li onclick="toggleDropdown(this)">Produits
            <div class="dropdown-content">
                <a href="#">Nouveau Produit</a>
                <a href="acheteur.php">Liste Produit</a>
                <a href="#">Option 3</a>
            </div>
        </li>
        <li onclick="toggleDropdown(this)">Ventes clients
            <div class="dropdown-content">
                <a href="creation_Compte.php">Nouveau Client </a>
                <a href="commande.php">Nouvelle commande</a>
                <a href="#">Liste Client</a>
                <a href="historique.php">Liste commande</a>
            </div>
        </li>

        <li onclick="toggleDropdown(this)">Stocks
            <div class="dropdown-content">
            <ul> <a href="modification.php">modification</a>
            <a href="vendeur.php">Inventaire</a>
              <a href="#">Option 3</a></ul>
            </div>
        </li>
        <li onclick="toggleDropdown(this)">Rapport
            <div class="dropdown-content">
          
            </div>
        </li>
        <li onclick="toggleDropdown(this)">Catégories
            <div class="dropdown-content">
            <a href="#">Aliments</a>
            <a href="#">Bureau</a>
            <a href="#">Cuisine</a>
            </div>
        </li>
    </ul>

</div>



<div class="main-content">

<br><br><br><br>
<div class="topbar">
<br><br><br><br>
<input type="text" placeholder="Recherche">
        </div>
<div class="dashboard">
    <div class="stats">
        <div class="stat-block">
            <h3>Commande Fournisseur</h3>
            <span>A valider: 1</span><br>
            <span>A réceptionner: 0</span><br>
            <span>Réception partielle: 0</span>
        </div>
        <div class="stats-block">
            <h3>Produits</h3>
            <span>Total: <?=$valeur['total']?></span><br>
            <span>Valeur du stock: </span><br>
            <span>Age stock: 8</span><br>
            <span>Rotation stock: 0</span>
        </div>
        <div class="stat-block">
            <h3>Commande Client</h3>
            <span>Attente Préparation: 1</span><br>
            <span>Attente Envoi: 0</span><br>
            <span>Clients: 4</span>
        </div>
    </div>
    <div class="alerts">
        <div class="alert-block">
            <h4>Alertes automatiques</h4>
        </div>
        <div class="alert-block">
            <h4>Stocks non traités</h4>
            <span>Total: 3</span>
        </div>
        <div class="alert-block">
            <h4>Articles à réapprovisionner</h4>
            <span>Total: 8</span>
        </div>
        <div class="alert-block">
            <h4>Stocks négatifs</h4>
            <span>Total: 5</span>
        </div>
    </div>
    <div class="chart">
        <h2>ÉVOLUTION DE STOCK</h2>
        <! Placeholder for chart >
        <div class="chart-placeholder">Graphique</div>
    </div>
</div>
</div>

</body>
</html>
    

         

     