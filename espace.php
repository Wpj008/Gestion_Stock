<?php 
session_start();
include "data.php";





$query = $data->prepare("SELECT COUNT(*) AS total FROM produits ");


$query->execute();

$valeur = $query->fetch();



$query = $data->prepare("SELECT * FROM produits " );

$query->execute();
  
$produits = $query->fetchAll();



$userscommandes = $data->prepare("SELECT *, COUNT(commandes.id_commande) as nbcommande FROM utilisateurs INNER JOIN commandes ON utilisateurs.id = commandes.utilisateur_id  
                                 GROUP BY utilisateurs.id ");



$userscommandes->execute();

 $commandes = $userscommandes->fetchAll();


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock</title>
    <link rel="stylesheet" href="css/vendeur.css">
    <link rel="stylesheet" href="css/button_profil.css">
    <script src="js/script.js"></script>
    
</head>
<body>
    <div class="user-info">
        <button class="profile-button" onclick="toggleProfile()">
            <img src="https://img.icons8.com/?size=100&id=23293&format=png&color=000000" alt="Photo de profil" class="profile-pic-large">
        </button>

        <div class="profile-info" id="profile-info">
            <h2><?= $_SESSION['nom'] ?><br> <?= $_SESSION['type'] ?></h2>
            <p><b>Email :</b> <?= $_SESSION['username'] ?></p>

            
        
    

    <div class="menu">
        <div class="menu-content">
            
        <a href="dataUser.php">Voir profil</a>
        

        </div>
    </div>
    </div>

    </div>


   
        <div class="logo">PM-stock</div>









<div class="main-content">


<br><br><br><br>
<div class="topbar">


<nav >

        
<ul>
    <li onclick="toggleDropdown(this)">Tableau de bord
        <div class="dropdown-content">
           
            <a href="espace.php">Espace vendeur</a>
            <a href="deconnexion.php">Deconnexion</a>
        </div>
    </li>
    <li onclick="toggleDropdown(this)">Produits
        <div class="dropdown-content">
            <a href="ajoutProduit.php">Nouveau Produit</a>
            <!--a href="acheteur.php">Liste Produit</a-->
        
        </div>
    </li>
    <li onclick="toggleDropdown(this)">Ventes clients
        <div class="dropdown-content">
            <a href="creation_Compte.php">Nouveau Client </a>
            <!--a href="commande.php">Nouvelle commande</a>
            <a href="#">Liste Client</a-->
            <a href="listeCommande.php">Liste commande</a>
            <a href="validationCommande.php ">Commandes non validée</a>
            <a href="livraisonCommande.php ">Commandes non livrée</a>
        </div>
    </li>
    <li onclick="toggleDropdown(this)">Stocks
        <div class="dropdown-content">
            <ul>
              
                <a href="vendeur.php">Inventaire</a>
              
            </ul>
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
   
</nav>

<br><br><br><br>
<!--input type="text" placeholder="Recherche"-->
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
            <span>Valeur du stock: <?/*=$solde*/?></span><br>
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
            <h4>Stock non traité</h4>
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
        <!-- Placeholder for chart-->
        <div class="chart-placeholder">
           
        </div>
    </div>
</div>
</div>

</body>
</html>
    

         

     