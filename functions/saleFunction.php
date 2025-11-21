<?php
include "data.php";


//function pour afficher all products + requete de jointure entre product, category  and supplier
function selctAllSale(){

    try{

     $query = $GLOBALS['data']->prepare("SELECT * FROM products");


$query->execute();
  
$produits = $query->fetchAll();

if($produits){

    return $produits;
}


} catch(PDOException $e){

    return "Il y a eu un probleme de la recuperation des infos des produits" . $e->getMessage();
}


}

// Enregistre la vente principale
function registerSale($user_id, $status, $total_sale) {
    try {
        $query = $GLOBALS['data']->prepare(" INSERT INTO sales (user_id, date_sale, status_id, total_sale) VALUES (:user_id, NOW(), :status_id, :total_sale)");

        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':status_id', $status);
        $query->bindParam(':total_sale', $total_sale);
        $query->execute();

        return $GLOBALS['data']->lastInsertId();
    }
    catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}


// Enregistre les produits liés à la vente
function registerRetailSale($sale_id, $product_ids, $quantities, $prices) {

    try {
        foreach ($product_ids as $index => $product_id) {

            $qty = $quantities[$index];
            $price = $prices[$index];
            $total = $qty * $price;

            $query = $GLOBALS['data']->prepare("INSERT INTO retail_sales(sale_id, product_id, quantity_retailSale, unit_price_retailSale, grand_total_retailSale) VALUES (:sale_id, :product_id, :qty, :price, :total)");

            $query->bindParam(':sale_id', $sale_id);
            $query->bindParam(':product_id', $product_id);
            $query->bindParam(':qty', $qty);
            $query->bindParam(':price', $price);
            $query->bindParam(':total', $total);

            $query->execute();
        }

    }
    catch (PDOException $e) {
        return "Erreur produits : " . $e->getMessage();
    }
}

?>