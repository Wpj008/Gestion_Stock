<?php 
session_start();
include "../data.php";
include "../functions/purchaseFunction.php";
include "../functions/productFunction.php";
include "../functions/userFunction.php";
include "../functions/supplierFunction.php";
include "../functions/saleFunction.php";


// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header('Location: ../index.php');  // Rediriger vers la page de connexion
    exit;  // Arrêter l'exécution des scripts suivants
}

//on recupere les infos du purchase 

$callPurchase = InnerJoinAllPurchase();//affiche la requete de jointure sur purchase et retailpurchase
$callProduct = selectAllProduct();//affiche tous les produits
$AllPurchase = selectAllPurchase();//affiche tous les achats
$numberUser = countUsers();//compte le nombre d'utilisateur
$numberSupplier = countSuppliers();//compte le nombre de fournisseur
$numberSale = countSales();//compte le nombre de sale
$numberPurchase = countPurchases();//compte le nombre de purchase

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-valider'])){

    //recuperations des id de purchase et retailpurchase
    $idretailPurchase = $_POST['ID_retailpurchase'];
    $idPurchase = $_POST['ID_purchase'];

    //new status
    $futurStatus = 2;

    //Requete pour modifier le status de l'article dans retailpurchase
    $queryUpdate = $GLOBALS['data']->prepare("UPDATE retail_purchases SET status_id_retail = :status_id WHERE id_retailPurchase = :id_retailpurchase");

    $queryUpdate->bindParam(':id_retailpurchase', $idretailPurchase);
    $queryUpdate->bindParam(':status_id', $futurStatus);

    $queryUpdate->execute();

    //requete qui compte le nombre d'article qui ont l'id status != 2
    $querySelect = $GLOBALS['data']->prepare("SELECT COUNT(*) FROM retail_purchases WHERE purchase_id = :purchase_id AND status_id_retail != 2");
    $querySelect->bindParam(':purchase_id', $idPurchase);


    $querySelect->execute();

    $result = $querySelect->fetchColumn();//ca affiche uniquement la colonne purchase id dans retailpurchase

    //si count(*) == 0 ; (cas d'une commande avec plusieurs articles)toutes les articles dans retailpurchase ont status_id == 2 alors on update le status_id dans purchase
    if($result == 0){
    $queryUpdateSelect = $GLOBALS['data']->prepare("UPDATE purchases SET status_id = :status_id WHERE id_purchase = :id_purchase");

    $queryUpdateSelect->bindParam(':id_purchase', $idPurchase);
    $queryUpdateSelect->bindParam(':status_id', $futurStatus);

    $queryUpdateSelect->execute();

}

}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-delete'])){

   // echo "JE TAIME";
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-confirmer'])){

    $idPurchase = $_POST['ID_purchase'];

    $futurStatus = 3;
    
    
    $queryUpdate = $GLOBALS['data']->prepare("UPDATE purchases SET status_id = :status_id WHERE id_purchase = :id_purchase");

    $queryUpdate->bindParam(':id_purchase', $idPurchase);
    $queryUpdate->bindParam(':status_id', $futurStatus);

    $queryUpdate->execute();


 }



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
                <h3>Total Employés</h3>
                <p class="value"><?= $numberUser['total'] ?></p>
            </div>

            <div class="stat-card green">
                <h3>Total Fournisseurs</h3>
                <p class="value"><?= $numberSupplier['valeur'] ?></p>
            </div>

            <div class="stat-card blue">
                <h3>Total Ventes</h3>
                <p class="value"><?= $numberSale['total'] ?></p>
            </div>

            <div class="stat-card gray">
                <h3>Total Achats</h3>
                <p class="value"><?= $numberPurchase['total'] ?></p>
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
                <h3> Produits En attente de Validation</h3>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>fournisseur</th>
                            <th>Vendeur</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                $i = 0;
                foreach($callPurchase as $purchase){

                  

                    if($purchase['status_id_retail'] == 1){

                        $i++;
                    
                    ?>
                    <tr>
                            <td><?= $i ?></td>
                            <td><?= $purchase['name_product'] ?></td>
                            <td><?= $purchase['quantity_retailPurchase'] ?></td>
                            <td><?= $purchase['name_supplier'] ?></td>
                            <td><?= $purchase['name_user'] ?></td>
                            <td><?= $purchase['grand_total_retailPurchase'] ?></td>
                            <td><?= $purchase['date_purchase'] ?></td>

                     <td>
                        <form method="POST">
                            <input name="ID_retailpurchase" type="hidden" value="<?= $purchase['id_retailPurchase'] ?>"/>
                            <input name="ID_purchase" type="hidden" value="<?= $purchase['id_purchase'] ?>"/>
                        <input name="submit-valider" type="submit" class="btn-view" value="Valider"/>
                        <input name="submit-delete" type="submit" class="btn-delete" value="Annuler"/>
                        </form>
                    </td>
                        </tr>

                        <?php  } }?>
                  
                    </tbody>
                </table>
            </div>

            <div class="alert-box">
                <h3>Produits Livrés</h3>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>fournisseur</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                $i = 0;
                foreach($callPurchase as $purchase){
                    
                    if($purchase['status_id'] == 2){

                        $i++;
                    
                    ?>
                    <tr>
                            <td><?= $i ?></td>
                            <td><?= $purchase['name_product'] ?></td>
                            <td><?= $purchase['quantity_retailPurchase'] ?></td>
                            <td><?= $purchase['name_supplier'] ?></td>
                            <td><?= $purchase['total_purchase'] ?></td>

                     <td>
                        <form method="POST">
                        <input name="ID_purchase" type="hidden" value="<?= $purchase['id_purchase'] ?>"/>
                     <input name="submit-confirmer" type="submit" class="btn-view" value="Confirmer Livraison"/>
                        </form>
                    </td>
                        </tr>

                        <?php } }?>
                  
                    </tbody>
                </table>
            </div>

        </section>


        <section class="alerts">

<div class="alert-box">
    <h3> Produits En attente d'approvisionnement</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Categorie</th>
                <th>Fournisseur</th>
                <th>Quantité</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
       // foreach($callProduct as $product){
            foreach($callPurchase as $purchase){
                if($purchase['status_id'] == 3){
            $i ++;
            ?>
            <tr>
           <td><?= $i ?></td>
           <td><?= $purchase['name_product'] ?></td>
           <td><?= $purchase['name_category'] ?></td>
           <td><?= $purchase['name_supplier'] ?></td>
           <td><?= $purchase['quantity_retailPurchase'] ?></td>
           <td><?= $purchase['grand_total_retailPurchase'] ?></td>

            </tr>

        <?php }  }?>
        </tbody>
    </table>
</div>


<div class="alert-box">
    <h3>Alertes Stock</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Categorie</th>
                <th>Fournisseur</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        foreach($callProduct as $product){

            if($product['quantity_product'] < 10){
            $i ++;
            ?>
            <tr>
           <td><?= $i ?></td>
           <td><?= $product['name_product'] ?></td>
           <td><?= $product['name_category'] ?></td>
           <td><?= $product['name_supplier'] ?></td>
           <td><?= $product['quantity_product'] ?></td>
           <td><?= $product['price_product'] ?></td>
           <td>
                        <a href="../add_purchase.php" class="btn-view">Commander</a>
                    </td>

            </tr>

        <?php } }?>
        </tbody>
    </table>

</div>

</section>


    </main>

</div>

</body>
</html>
