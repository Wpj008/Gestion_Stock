<?php
session_start();
include "data.php";
include "header.php";
include "functions/userFunction.php";
include "functions/purchaseFunction.php";
include "functions/productFunction.php";

$checkLog = checkLogin(); // Vérifie la connexion

//$callPurchase = selectAllPurchase(); // Récupération fournisseurs + produits
$callProduct = selectAllProduct();
$success = "";

$InnerPurchase = InnerJoinAllPurchase();// Récupération des achats avec jointures des autres tables



if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

       
    $status     = 1;                         
    $user       = $_SESSION['id_user'];  
    $supplier  = $_POST['supplierInput']; 

    // Récupération de l'ID du fournisseur à partir du nom    
    $querySupplier = $GLOBALS['data']->prepare("SELECT * FROM suppliers WHERE  name_supplier = :namesupplier");
    $querySupplier->bindParam(':namesupplier', $supplier);
    $querySupplier->execute();
    $resultSupplier = $querySupplier->fetch();

    if($resultSupplier){

        $supplierID = $resultSupplier['id_supplier'];//on recupère l'id du fournisseur

    } 

 
  
    // recuperations de tableau des valeurs
   $product_ids = isset($_POST['productID']) ? $_POST['productID'] : [];
    $quantities  = isset($_POST['quantity'])  ? $_POST['quantity']  : [];
    $prices      = isset($_POST['price'])     ? $_POST['price']     : [];
    $payment     = $_POST['paymentPurchase'] ?? 'Espèces' || 'Virement Bancaire';

    // Vérification que des produits ont été ajoutés
    if (empty($product_ids)) {
        echo "<p style='color:red;'>Erreur : aucun produit n'a été ajouté.</p>";
        return;
    }

    //sauvegardes de tous les champs dans la function finale
    $savePurchase = registerAllPurchase($supplierID, $user, $status, $product_ids, $quantities, $prices, $payment);

    echo "<p style='color:green;'>$success</p>";
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-Add'])){

    $idProduct = $_POST['ID_product'];//on recupère l'id du produit
    $idPurchase = $_POST['ID_purchase'];//on recupère l'id de l'achat

    $statusPurchase = $_POST["statusPurchase"];//on recupère le status de l'achat
    $bdd_qty = $_POST['quantity'];//on recupère la quantité en bdd
    $add_qty = $_POST['retail_quantity'];//on recupère la quantité à ajouter

    $newQty = $bdd_qty + $add_qty;//calcul de la nouvelle quantité


    $status = $_POST['ID_status'];//on recupère le status du produit

    $newStatus = 5;//nouveau status = en stock

    // Mise à jour de la quantité du produit dans la table products
  $query = $GLOBALS['data']->prepare("UPDATE products SET quantity_product = :quantity WHERE id_product = :idproduct");

  $query->bindParam(':quantity', $newQty);
  $query->bindParam(':idproduct', $idProduct);
  $query->execute();

  // Mise à jour du statut de l'achat dans la table purchases
  $queryUpPurchase = $GLOBALS['data']->prepare("UPDATE purchases SET status_id = :idStatus WHERE id_purchase = :idpurchase");

  $queryUpPurchase->bindParam(':idStatus', $newStatus);
  $queryUpPurchase->bindParam(':idpurchase', $idPurchase);
  $queryUpPurchase->execute();

  if($status != 5){//si le status du produit n'est pas deja en stock on le met à jour

    // Mise à jour du statut du produit dans la table products
    $queryUpdate = $GLOBALS['data']->prepare("UPDATE products SET product_status = :status WHERE id_product = :idproduct ");

    $queryUpdate->bindParam(':status', $newStatus);
    $queryUpdate->bindParam(':idproduct', $idProduct);

     $queryUpdate->execute();
  }



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
                <th>Article</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Paiement</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php
        $i = 0;

        foreach($InnerPurchase as $purchase){//on parcourt les achats avec jointures des autres tables

            if($purchase['status_id'] == 3){
            
            $i++
            ?>

            <tr>
                <td><?= $i ?></td>
                <td><?= $purchase['name_supplier'] ?></td>
                <td><?= $purchase['name_product'] ?></td>
                <td><?= $purchase['quantity_retailPurchase']  ?></td>
                <td><?= $purchase['grand_total_retailPurchase'] ?> €</td>
                <td><?= $purchase['payment_method_purchase'] ?></td>
                <td><span class="badge success">Livré</span></td>
                <td><?= $purchase['date_purchase']  ?></td>
                <td>
                    <form method="POST">

                   
                    <input name="statusPurchase" type="hidden" value="<?= $purchase['status_id'] ?>"/>
                    <input name="ID_purchase" type="hidden" value="<?= $purchase['id_purchase'] ?>"/>
                    <input name="retail_quantity" type="hidden" value="<?= $purchase['quantity_retailPurchase']  ?>"/>
                    <input name="ID_product" type="hidden" value="<?= $purchase['product_id'] ?>"/>
                    <input name="quantity" type="hidden" value="<?= $purchase['quantity_product'] ?>"/>
                    <input name="ID_status" type="hidden" value="<?= $purchase['product_status'] ?>"/>
                    <input name="submit-Add" type="submit" class="btn small view" value="Ajouter"/>
                    </form>
                   
                </td>
            </tr>

            <?php  } }?>
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
                 
                    <input name="supplierInput" id="supplierInput" type="text" placeholder="Nom Fournisseur" readonly>
                    <input  name="supplierID" id="supplierID" type="hidden">
                   
               
                </div>

                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" disabled>
                </div>

                <div class="form-group">
                    <label>Mode de paiement</label>
                    <select name="paymentPurchase" id="paymentPurchase">
                        <option>Espèces</option>
                        <option>Virement Bancaire</option>
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

                                        <?php foreach($callProduct as $product) { ?>
                                     <option 
                                            value="<?= $product['id_product']; ?>"
                                            data-price="<?= $product['price_product_purchase']; ?>"
                                            data-supplier="<?= $product['name_supplier']?>"
                                            data-supplier-id="<?= $product['supplier_id'] ?>"
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
                  
                    <input name="priceInput" id="priceInput" type="number" step="0.01" placeholder="00.0" readonly>
                   
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
                <input id="totalInput" name="totalInput" type="number" step="0.01"  placeholder="00.0" readonly>
            </div><br><br>

            <p id="successmessage" style="color: green;"><?= $success; ?></p>

            <input name="submit" class="btn-save" type="submit" value= "Valider la commande" >

        </form>
    </div>

</div>

<script src="js/script.js"></script>

</body>
</html>


