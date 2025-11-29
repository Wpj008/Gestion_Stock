<?php 
session_start();
include "data.php";
include "functions/userFunction.php";
include "functions/productFunction.php";


$checkLog = checkLogin();//check connection

$callProduct  = selectAllProduct();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Dashboard Employé</title>
</head>
<body>
<div class="employee-dashboard">

    <!-- Sidebar employé -->
    <aside class="sidebar">
        <h2 class="logo">STOCK<span>EMP</span></h2>

        <nav class="menu">
            <a href="#" class="active">Dashboard</a>
            <a href="add_sale.php">Ventes</a>
            <a href="add_purchase.php">Stock</a>
            <a href="#">Clients</a>
            <a href="dataUser.php">Profil</a>
        </nav>
    </aside>

    <!-- Contenu -->
    <main class="content">

        <h1>Bienvenue, <?= $_SESSION['name_user'] ?></h1>

        <!-- Statistiques personnelles -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <h3>Ventes du jour</h3>
                <p class="value">0 €</p>
            </div>

            <div class="stat-card green">
                <h3>Ventes du mois</h3>
                <p class="value">0 €</p>
            </div>

            <div class="stat-card purple">
                <h3>Tickets réalisés</h3>
                <p class="value">0</p>
            </div>

            <div class="stat-card orange">
                <h3>Total vendu (perso)</h3>
                <p class="value">0 €</p>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="quick-actions">
            <h2>Actions rapides</h2>
            <div class="actions-grid">
                <button class="action-btn blue">+ Nouvelle Vente</button>
                <button class="action-btn green">+ Ajouter Client</button>
                <button class="action-btn purple">📦 Voir Stock</button>
            </div>
        </div>

        <!-- Stock critique -->
        <div class="alert-section">
            <h2>Produits en rupture</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Produit</th>
                        <th>Stock</th>
                    </tr>

                </thead>
                <tbody>

                <?php    $i = 0;
                    
                    foreach($callProduct as $product){
                        
                        if($product['quantity_product'] <= 10){
                         
                            $i++;
                        ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $product['name_product'] ?></td>
                        <td><?= $product['name_supplier'] ?></td>
                        <td><span class="badge red"><?= $product['quantity_product'] ?></span></td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>

        <!-- Dernières ventes employé -->
        <div class="sales-section">
            <h2>Dernières ventes</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="empty">Aucune vente pour le moment</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

</div>
</body>
</html>