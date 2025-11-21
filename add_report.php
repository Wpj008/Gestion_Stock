<?php
session_start();
include "data.php";
include "header.php";
include "functions/userFunction.php";

$checkLog = checkLogin();//check connection

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_report.css">
    <title>Rapport</title>
</head>
<body>
    

<div class="report-container">

    <!-- Header -->
    <div class="report-header">
        <h1>Rapports & Statistiques</h1>

        <div class="report-filters">
            <label>Du</label>
            <input type="date">

            <label>Au</label>
            <input type="date">

            <button class="btn-filter">Filtrer</button>
        </div>
    </div>

    <!-- Statistiques principales -->
    <div class="report-stats">

        <div class="report-card blue">
            <h3>Total Ventes</h3>
            <p class="value">19 000.00 €</p>
        </div>

        <div class="report-card green">
            <h3>Total Achats</h3>
            <p class="value">12 950.00 €</p>
        </div>

        <div class="report-card orange">
            <h3>Total Dépenses</h3>
            <p class="value">2 350.00 €</p>
        </div>

        <div class="report-card purple">
            <h3>Bénéfice Net</h3>
            <p class="value">3 700.00 €</p>
        </div>

    </div>

    <!-- Graphiques (placeholders) -->
    <div class="report-charts">

        <div class="chart-box">
            <h3>Ventes mensuelles</h3>
            <div class="chart-placeholder"></div>
        </div>

        <div class="chart-box">
            <h3>Achats mensuels</h3>
            <div class="chart-placeholder"></div>
        </div>

        <div class="chart-box">
            <h3>Dépenses mensuelles</h3>
            <div class="chart-placeholder"></div>
        </div>

        <div class="chart-box">
            <h3>Produits les plus vendus</h3>
            <div class="chart-placeholder"></div>
        </div>
    </div>

    <!-- Tableaux -->
    <div class="report-tables">

        <div class="table-box">
            <h3>Top Clients</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Total Achat</th>
                        <th>Achat moyen</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>Jean Dupont</td><td>2 560 €</td><td>320 €</td></tr>
                    <tr><td>2</td><td>Entreprise ABC</td><td>4 180 €</td><td>697 €</td></tr>
                </tbody>
            </table>
        </div>

        <div class="table-box">
            <h3>Top Produits Vendus</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Total généré</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>Adata XPG 8GB DDR4</td><td>25</td><td>1 875 €</td></tr>
                    <tr><td>2</td><td>Intel Core i5-10400</td><td>19</td><td>3 420 €</td></tr>
                </tbody>
            </table>
        </div>

    </div>

</div>



</body>
</html>