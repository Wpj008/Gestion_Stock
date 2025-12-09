<?php 
session_start();
include "data.php";
include "functions/productFunction.php";
include "header.php";
include "functions/userFunction.php";

$checkLog = checkLogin();

$successmessage = "";
$errormessage = "";

$idUser = $_SESSION['id_user'];

$callProduct  = selectAllProduct();
$callCategory = selectAllCategory();
$callSupplier = selectAllSupplier();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

    // Récupération sécurisée des données
    $name        = htmlspecialchars($_POST['name'] ?? '');
    $supplier    = htmlspecialchars($_POST['supplier'] ?? '');
    $category    = htmlspecialchars($_POST['category'] ?? '');
    $quantity    = htmlspecialchars($_POST['quantity'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');
    $priceSALe        = htmlspecialchars($_POST['priceSale'] ?? '');
    $pricePurchase  = htmlspecialchars($_POST['pricePurchase'] ?? '');
    $etat_produit = 5 ;
    $picture     = $_FILES['image']['name'] ?? '';

    // Validation minimale
    if (empty($name) || empty($priceSALe) || empty($quantity) || empty($description) || empty($pricePurchase)) {
        $errormessage = "Veuillez remplir tous les champs obligatoires.";
    } else {

        // Enregistrement
        $addProduct = registerProduct($name, $supplier, $quantity, $description, $priceSALe, $pricePurchase, $picture, $category, $etat_produit);

        $successmessage = "Produit ajouté avec succès.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/add_product.css">
    <script src="js/verification.js"></script>
    <title>Ajout Produuit</title>
</head>
<body>
<br><br>
<div class="stock-container">

<!-- Header -->
<div class="stock-header">
    <h1>Gestion du Stock</h1>
    <button class="btn-add">+ Ajouter un Produit</button>
</div>

<!-- Tableau Stock -->
<div class="stock-table">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom produit</th>
                <th>Fournisseur</th>
                <th>Catégorie</th>
                <th>Stock</th>
                <th>Prix Vente</th>
                <th>Prix Achat</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $i =0; 
            foreach($callProduct as $product){
                $i++
                ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $product['name_product']; ?></td>
                <td><?= $product['name_supplier']; ?></td>
                <td><?= $product['name_category']; ?></td>
                <td><span class="badge normal"><?= $product['quantity_product']; ?></span></td>
                <td><?= $product['price_product_sale']; ?> €</td>
                <td><?= $product['price_product_purchase']; ?> €</td>
                <td>
                    <button class="btn small edit">Modifier</button>
                    <button class="btn small delete">Supprimer</button>
                </td>
            </tr>

            <?php }?>


        </tbody>
    </table>
</div>

<!-- Formulaire -->
<div class="stock-form">
    <h2>Ajouter un Produit</h2>

    <form method="POST" enctype="multipart/form-data"> 

        <div class="form-grid">

            <div class="form-group">
                <label>Nom du produit</label>
                <input name="name" id="name" type="text" placeholder="nom du produit">
               
            </div>

            <div class="form-group">
                <label>Catégorie</label>
                <select name="category">
                <?php foreach($callCategory as $category){?>
               
                    <option value="<?= $category['id_category']; ?>"><?= $category['name_category']; ?></option>
        
                <?php }?>

                </select>
            </div>


            <div class="form-group">
                <label>Quantité à commander</label>
                <input id="quantity" name="quantity" type="number" placeholder="0">
            </div>

            <div class="form-group">
                <label>Fournisseur</label>
                <select name="supplier">
                <?php foreach($callSupplier as $supplier){?>
                
                    <option value="<?= $supplier['id_supplier']; ?>"><?= $supplier['name_supplier']; ?></option>
                
                <?php }?>
                </select>
            </div>

            <div class="form-group">
                <label>Prix de vente</label>
                <input id="priceSale" name="priceSale" type="number" placeholder="0.00">
            </div>

            <div class="form-group">
                <label>Prix d'Achat</label>
                <input id="pricePurchase" name="pricePurchase" type="number" placeholder="0.00">
            </div>

            <div class="form-group">
                <label>Description du produit</label>
                <textarea id="description" name="description" type="text" placeholder="Description du produit"></textarea>
            </div>

            <div class="form-group">
                <label>Image du produit</label>
                <input type="file" id="image" name="image"><br>
            </div>

            <p id="successmessage" style="color: green;"><?= $successmessage; ?></p>

            <p id="errormessage" style="color: red;"><?= $errormessage; ?></p>

        </div>

        <input class="btn-save" name="submit" type="submit" value="Enregistrer" />

    </form>
</div>

</div>
</body>
</html>

