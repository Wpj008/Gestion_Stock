<?php
include "data.php";


//function pour afficher all products + requete de jointure entre product, category  and supplier
function selctAllPurchase(){

    try{

     $query = $GLOBALS['data']->prepare("SELECT * FROM categories INNER JOIN products ON categories.id_category = products.category_id INNER JOIN suppliers ON suppliers.id_supplier = products.supplier_id INNER JOIN retail_purchases ON retail_purchases.product_id = products.id_product");


$query->execute();
  
$produits = $query->fetchAll();

if($produits){

    return $produits;
}


} catch(PDOException $e){

    return "Il y a eu un probleme de la recuperation des infos des produits" . $e->getMessage();
}


}

//creation des infos dans la table purchase
function createPurchase($supplier_id, $user_id, $status_id, $total_purchase)
{
    try {
        $query = $GLOBALS['data']->prepare(" INSERT INTO purchases(supplier_id, user_id, status_id, total_purchase) VALUES (:supplier, :user, :status, :total)");

        $query->bindParam(':supplier', $supplier_id);
        $query->bindParam(':user', $user_id);
        $query->bindParam(':status', $status_id);
        $query->bindParam(':total', $total_purchase);

        $query->execute();

        // Retourner l'id du nouvel achat
        return $GLOBALS['data']->lastInsertId();

    } catch (PDOException $e) {
        return "Erreur lors de l'enregistrement de l'achat : " . $e->getMessage();
    }
}


//creation des infos pour la table reatil_purchase
function addPurchaseLine($purchase_id, $product_id, $quantity, $unit_price)
{
    try {
        $total = $quantity * $unit_price;

        $query = $GLOBALS['data']->prepare("INSERT INTO retail_purchases(purchase_id, product_id, quantity_retailPurchase, unit_price_retailPurchase, grand_total_retailPurchase)VALUES (:purchase, :product, :qty, :price, :total)");

        $query->bindParam(':purchase', $purchase_id);
        $query->bindParam(':product', $product_id);
        $query->bindParam(':qty', $quantity);
        $query->bindParam(':price', $unit_price);
        $query->bindParam(':total', $total);

        $query->execute();


    } catch (PDOException $e) {
        return "Erreur lors de la recuperation des infos pour le produit : " . $e->getMessage();
    }
}

//funtion permettant de recuperer tous les produits commandé
function savePurchaseProducts($purchase_id, $product_ids, $quantities, $prices)
{
    foreach ($product_ids as $index => $prodId) {//usage des dictionnaire (clé => valeur)

        $qty = $quantities[$index];
        $price = $prices[$index];

        addPurchaseLine($purchase_id, $prodId, $qty, $price);//on fait appel à la premeire function pour save dans la table purchase
    }

    $success = "Produits enregistrés.";
    echo $success;
}

//function finale, on recupère toutes les infos et on fait la requete finale pour retail_purchase
function registerAllPurchase($supplier_id, $user_id, $status, $product_ids, $quantities, $prices)
{
    // Calcul total
    $total = 0;

    foreach ($product_ids as $index => $pid) {
        $total += $quantities[$index] * $prices[$index];
    }

    // Enregistrer l'achat
    $purchase_id = createPurchase($supplier_id, $user_id, $status, $total);

    // Enregistrer les produits
    savePurchaseProducts($purchase_id, $product_ids, $quantities, $prices);

    $success = "Achat complet enregistré";

    echo $success;
}


function InnerJoinAllPurchase(){

    try{

     $query = $GLOBALS['data']->prepare("SELECT * FROM retail_purchases INNER JOIN products ON retail_purchases.product_id = products.id_product INNER JOIN purchases ON purchases.id_purchase = retail_purchases.purchase_id  INNER JOIN suppliers ON suppliers.id_supplier = products.supplier_id ");


$query->execute();
  
$produits = $query->fetchAll();

if($produits){

    return $produits;
}

} catch(PDOException $e){

    return "Il y a eu un probleme de la recuperation des infos des produits" . $e->getMessage();
}


}


?>

