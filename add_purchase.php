<?php
session_start();
include "data.php";
include "header.php";
include "functions/userFunction.php";
include "functions/purchaseFunction.php";

$checkLog = checkLogin(); // Vérifie la connexion

$callPurchase = selctAllPurchase(); // Récupération fournisseurs + produits
$success = "";


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

   
    $supplier   = $_POST['supplierInput'];     
    $status     = 1;                         
    $user       = $_SESSION['id_user'];    

    
    // recuperations de tableau des valeurs
    $product_ids = isset($_POST['productID']) ? $_POST['productID'] : [];
    $quantities  = isset($_POST['quantity'])  ? $_POST['quantity']  : [];
    $prices      = isset($_POST['price'])     ? $_POST['price']     : [];

    // Vérification que des produits ont été ajoutés
    if (empty($product_ids)) {
        echo "<p style='color:red;'>Erreur : aucun produit n’a été ajouté.</p>";
        return;
    }

    //sauvegardes de tous les champs
    $savePurchase = registerAllPurchase($supplier, $user, $status, $product_ids, $quantities, $prices);

    echo "<p style='color:green;'>$success</p>";
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_purchase.css">
    <title>Gestion des Achats</title>
</head>

<body>

<div class="purchase-container">


<!-- Tableau des Achats -->
<div class="purchase-table" style="margin-top: 20px;">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Fournisseur</th>
                <th>Date</th>
                <th>Articles</th>
                <th>Total</th>
                <th>Paiement</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>TechPlus SARL</td>
                <td>15/02/2025</td>
                <td>6</td>
                <td>4500.00 €</td>
                <td>Virement</td>
                <td><span class="badge success">Payé</span></td>
                <td>
                    <button class="btn small view">Voir</button>
                    <button class="btn small delete">Supprimer</button>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Global Hardware</td>
                <td>10/02/2025</td>
                <td>3</td>
                <td>980.00 €</td>
                <td>Espèces</td>
                <td><span class="badge partial">Partiel</span></td>
                <td>
                    <button class="btn small view">Voir</button>
                    <button class="btn small delete">Supprimer</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

    <!-- Formulaire Nouvel Achat -->
    <div class="purchase-form">
        <h2>Enregistrer un Achat</h2>

        <!-- FORMULAIRE DES INFORMATIONS PRINCIPALES -->
        <form method="POST" id="purchaseForm" >

            <div class="form-grid">
                <div class="form-group">
                    <label>Fournisseur</label>
                    <input name="supplierInput" id="supplierInput" type="text" placeholder="Nom Fournisseur">
               
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
                        <option>Chèque</option>
                        <option>Mobile Money</option>
                        <option>Virement</option>
                    </select>
                </div>

            </div>

            <h3>Ajouter un produit</h3>

            <!-- FORMULAIRE D'AJOUT DE PRODUIT -->
            <div class="product-grid">
                <div class="product-group">
                    <label>Produit</label>
                    <select name="productID" id="productSelect" required>
                                          <option value="">Sélectionnez un produit</option>

                                        <?php foreach($callPurchase as $product) { ?>
                                     <option 
                                            value="<?= $product['id_product']; ?>"
                                            data-price="<?= $product['price_product']; ?>"
                                            data-supplier="<?= $product['name_supplier']?>"
                                         >
                                         <?= $product['name_product']; ?>
                                 </option>
                            <?php } ?>
                        </select>

                </div>

                <div class="product-group">
                    <label>Quantité</label>
                    <input name="quantityInput" id="quantityInput" type="number" min="1" value="1">
                </div>

                <div class="product-group">
                    <?php ?>
                    <label>Prix unitaire (€)</label>
                  
                    <input name="priceInput" id="priceInput" type="number" step="0.01" placeholder="00.0">
                   
                </div>
            </div>

            <button type="button" class="btn-add" onclick="addProduct()">+ Ajouter le produit</button>

            <h3>Produits ajoutés</h3>

            <!-- TABLEAU DES PRODUITS AJOUTÉS -->
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

            <!-- TOTAL GLOBAL -->
            <div class="form-group" style="margin-top:20px;">
                <label>Total de l'achat (€)</label>
                <input id="totalInput" type="number" step="0.01" value="0" readonly>
            </div><br><br>

            <p id="successmessage" style="color: green;"><?= $success; ?></p>

            <input name="submit" class="btn-save" type="submit" value= "Valider la commande" >

        </form>
    </div>

</div>

<script src="js/script.js"></script>

</body>
</html>


