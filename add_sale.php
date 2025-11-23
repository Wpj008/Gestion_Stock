<?php
session_start();
include "data.php";
include "header.php";
include "functions/userFunction.php";
include "functions/saleFunction.php";

$checkLog = checkLogin();//check connection

$callSale = selectAllSale();

$nameUser = $_SESSION['name_user'];

$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

    $user   = $_SESSION['id_user'];
    $status = 4;

    // TABLEAUX ENVOYÉS PAR LES INPUTS CACHÉS
    $product_ids = $_POST['productID'] ?? [];
    $quantities  = $_POST['quantity']  ?? [];
    $prices      = $_POST['price']     ?? [];
    $total       = $_POST['total_sale'] ?? 0;

    if (empty($product_ids)) {
        echo "<p style='color:red;'>Erreur : aucun produit ajouté.</p>";
        exit;
    }

    //  Enregistrer la vente
    $sale_id = registerSale($user, $status, $total);

    if (!is_numeric($sale_id)) {
        echo $sale_id; // affiche erreur SQL
        exit;
    }

    //  Enregistrer les produits de la vente
    $result = registerRetailSale($sale_id, $product_ids, $quantities, $prices);

    echo "<p style='color:green;'>Vente enregistrée avec succès.</p>";
}

//affiche la requete de jointure
$InnerSale = InnerJoinTableSale();


?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_sale.css">
    <title>Créer une Vente</title>
</head>

<body>


 <div class="sales-header">
        <h1>Gestion des Ventes</h1>
        <button class="btn-add">+ Nouvelle Vente</button>
    </div>

    <!-- Tableau -->
    <div class="sales-table">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vendeur</th>
                    <th>Articles</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Paiement</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                
                $i = 0;
                            
                        foreach($InnerSale as $sales){
                    $i++;  
                    ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $sales['name_user']  ?></td>
                    <td><?= $sales['name_product'] ?></td>
                    <td><?= $sales['quantity_retailSale'] ?></td>
                    <td><?= $sales['grand_total_retailSale'] ?> €</td>
                    <td>Espèces</td>
                    <td><?= $sales['date_sale'] ?></td>
                    <td>
                        <button class="btn small view">Voir</button>
                        <button class="btn small delete">Supprimer</button>
                    </td>
                </tr>

                <?php }?>

            
            </tbody>
        </table>
    </div>



<div class="sales-container">

    <!-- Header -->
    <div class="sales-header">
        <h1>Gestion des Ventes</h1>
     
    </div>

    <!-- Formulaire de vente -->
    <div class="sales-form">
        <h2>Créer une Vente</h2>

        <!-- FORMULAIRE DE VENTE -->
        <form method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Vendeur</label>
                    <input type="text" value="<?= $nameUser ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" required>
                </div>

                <div class="form-group">
                    <label>Mode de paiement</label>
                    <select name="paiement">
                        <option>Espèces</option>
                        <option>Carte Bancaire</option>
                        <option>Mobile Money</option>
                        <option>Chèque</option>
                        <option>Virement</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Montant payé</label>
                    <input type="number" name="montant_paye" step="0.01" placeholder="0.00">
                </div>

            </div>

            <h3>Produits</h3>

            <div class="product-grid">

                <!-- PRODUIT -->
                <div class="product-group">
                    <label>Produit</label>
                    <select id="productSelect">
                        <option value="">Sélectionner un produit</option>

                        <?php foreach($callSale as $sale){ ?>
                            <option value="<?= $sale['id_product'] ?>"
                                    data-price="<?= $sale['price_product'] ?>">
                                <?= $sale['name_product'] ?>
                            </option>
                        <?php } ?>

                    </select>
                </div>

                <!-- QUANTITÉ -->
                <div class="product-group">
                    <label>Quantité</label>
                    <input id="quantityInput" type="number" min="1" value="1">
                </div>

                <!-- PRIX -->
                <div class="product-group">
                    <label>Prix (€)</label>
                    <input id="priceInput" type="number" step="0.01" placeholder="0.00">
                </div>

            </div>

            <!-- BOUTON AJOUTER PRODUIT -->
            <button type="button" class="btn-add" onclick="addVente()">+ Ajouter un produit</button>

            <h3>Produits ajoutés</h3>

            <!-- TABLEAU PRODUITS -->
            <table class="purchase-table" id="productsTable">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix (€)</th>
                        <th>Sous-total (€)</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="tableBody">
                </tbody>
            </table>

            <!-- TOTAL -->
            <div class="form-group" style="margin-top: 20px;">
                <label>Total ( € )</label>
                <input id="total_sale" name="total_sale" type="number" step="0.01" value="0" readonly>
            </div>

            <!-- MESSAGE SUCCESS -->
            <p id="successmessage" style="color: green;"><?= $success ?></p>

            <!-- SUBMIT -->
            <input class="btn-save" type="submit" name="submit" value= "Valider la vente">

        </form>

    </div>

</div>

<script src="js/script.js"></script>

</body>
</html>
