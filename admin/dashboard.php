<?php 

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion de Stock</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<div class="layout">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo">STOCK<span>ADMIN</span></h2>

        <nav class="menu">
            <a href="#" class="active">Dashboard</a>
            <a href="#">Clients</a>
            <a href="../add_supplier.php">Fournisseurs</a>
            <a href="../add_category.php">Catégories</a>
            <a href="../add_product.php">Stock</a>
            <a href="../add_sale.php">Ventes</a>
            <a href="../add_purchase.php">Achats</a>
            <a href="../add_expense.php">Dépenses</a>
            <a href="../add_report.php">Rapports</a>
            <a href="../add_setting.php">Paramètres</a>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="content">

        <h1>Bienvenue dans le système de gestion de stock</h1>

        <!-- Stats -->
        <section class="stats-grid">
            <div class="stat-card red">
                <h3>Total Clients</h3>
                <p class="value">1</p>
            </div>

            <div class="stat-card green">
                <h3>Total Fournisseurs</h3>
                <p class="value">1</p>
            </div>

            <div class="stat-card blue">
                <h3>Total Ventes</h3>
                <p class="value">19 000.00</p>
            </div>

            <div class="stat-card gray">
                <h3>Total Achats</h3>
                <p class="value">191 845.00</p>
            </div>
        </section>

        <!-- Today / Monthly Section -->
        <section class="dual-box">
            <div class="box today">
                <h3>Aujourd’hui</h3>
                <p>Ventes : —</p>
                <p>Achats : —</p>
            </div>

            <div class="box month">
                <h3>Mensuel</h3>
                <p>Ventes : 19 000.00</p>
                <p>Achats : 195 495.00</p>
            </div>
        </section>

        <!-- Alerts -->
        <section class="alerts">

            <div class="alert-box">
                <h3>Alertes Produits Usine</h3>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="4" class="empty">Aucun produit</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="alert-box">
                <h3>Alertes Stock</h3>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>P1689942673</td>
                            <td>Intel Core i5-10400</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>P1689943120</td>
                            <td>Adata XPG 8GB DDR4</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>


        <section class="alerts">

<div class="alert-box">
    <h3>Alertes Produits Usine</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nom</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            <tr><td colspan="4" class="empty">Aucun produit</td></tr>
        </tbody>
    </table>
</div>

<div class="alert-box">
    <h3>Alertes Stock</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nom</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>P1689942673</td>
                <td>Intel Core i5-10400</td>
                <td>0</td>
            </tr>
            <tr>
                <td>2</td>
                <td>P1689943120</td>
                <td>Adata XPG 8GB DDR4</td>
                <td>0</td>
            </tr>
        </tbody>
    </table>
</div>

</section>

    </main>

</div>

</body>
</html>
