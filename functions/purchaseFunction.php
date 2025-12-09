<?php
include __DIR__."/../data.php";


//creation des infos dans la table purchase
function createPurchase($supplier_id, $user_id, $status_id, $total_purchase, $payment) {

    try {
        $query = $GLOBALS['data']->prepare(" INSERT INTO purchases(supplier_id, user_id, status_id, total_purchase, payment_method_purchase) VALUES (:supplier, :user, :status, :total, :payment) ");

        $query->bindParam(':supplier', $supplier_id);
        $query->bindParam(':user', $user_id);
        $query->bindParam(':status', $status_id);
        $query->bindParam(':total', $total_purchase);
        $query->bindParam(':payment', $payment);

        $query->execute();

        // Retourner l'id du nouvel achat
        return $GLOBALS['data']->lastInsertId();

    } catch (PDOException $e) {
        echo "<p style='color:red;'> Erreur lors de l'enregistrement de purchase : " . $e->getMessage()."</p>";
        return false;
    }
}


//creation des infos pour la table reatil_purchase
function addPurchaseLine($purchase_id, $product_id, $quantity, $unit_price){

    try {
        $total = $quantity * $unit_price;
        $status = 1;

        $query = $GLOBALS['data']->prepare("INSERT INTO retail_purchases(purchase_id, product_id, status_id_retail, quantity_retailPurchase, unit_price_retailPurchase, grand_total_retailPurchase)VALUES (:purchase, :product, :status_id, :qty, :price, :total)");

        $query->bindParam(':purchase', $purchase_id);
       
        $query->bindParam(':product', $product_id);
        $query->bindParam(':status_id', $status);
        $query->bindParam(':qty', $quantity);
        $query->bindParam(':price', $unit_price);
        $query->bindParam(':total', $total);

        $query->execute();


    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erreur lors de l'enregistrement dans retailpurchase :  ".$e->getMessage()."</p>";
    }
}

//funtion permettant de recuperer tous les produits commandé
function savePurchaseProducts($purchase_id, $product_ids, $quantities, $prices){

    foreach ($product_ids as $index => $prodId) {//usage des dictionnaire (clé => valeur)

        $qty = $quantities[$index];
        $price = $prices[$index];

        addPurchaseLine($purchase_id, $prodId, $qty, $price);//on fait appel à la premeire function pour save dans la table purchase
    }

    echo "<p style='color:green;'>Produits enregistrés.</p>";
}

//function finale, on recupère toutes les infos et on fait la requete finale pour retail_purchase
function registerAllPurchase($supplier_id, $user_id, $status, $product_ids, $quantities, $prices, $payment) {

    // Calcul total
    $total = 0;

    foreach ($product_ids as $index => $pid) {
        $total += $quantities[$index] * $prices[$index];
    }

    // Enregistrer l'achat
    $purchase_id = createPurchase($supplier_id, $user_id, $status, $total,$payment);

    if (!$purchase_id) {
        echo "<p style='color:red;'>Enregistrement interrompu : purchase non créé.</p>";
        return;
}

    // Enregistrer les produits
    savePurchaseProducts($purchase_id, $product_ids, $quantities, $prices);

    echo "<p style='color:green;'>Achat complet enregistré.</p>";
}


function InnerJoinAllPurchase(){

    try{

     $query = $GLOBALS['data']->prepare("SELECT * FROM retail_purchases INNER JOIN products ON retail_purchases.product_id = products.id_product INNER JOIN purchases ON purchases.id_purchase = retail_purchases.purchase_id  
     INNER JOIN suppliers ON suppliers.id_supplier = products.supplier_id INNER JOIN users ON users.id_user = purchases.user_id INNER JOIN categories ON categories.id_category = products.category_id");


$query->execute();
  
$produits = $query->fetchAll();

if($produits){

    return $produits;
}

} catch(PDOException $e){

    echo "<p style='color:red;'>Erreur, Il y a eu un probleme de la recuperation des infos des produits : ".$e->getMessage()."</p>";
    return false;
}


}

//function affiche all purchases

function selectAllPurchase(){

    try{

    $query = $GLOBALS['data']->prepare("SELECT * FROM purchases " );

$query->execute();
  
$purchase = $query->fetchAll();

if($purchase){

    return $purchase;
}


} catch(PDOException $e){

    echo "<p style='color:red;'> Erreur, Il y a eu un probleme de la recuperation des infos des achats : ".$e->getMessage()."</p>";
    return false;
}


}

//=============================================
//function pour afficher le nombre de purchase

function countPurchases(){

    try{

         $query = $GLOBALS['data']->prepare("SELECT COUNT(*) AS total FROM purchases WHERE status_id = 5");
            $query->execute();
            $result = $query->fetch();
            if($result){

                return $result;
            }
    } catch(PDOException $e){
        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation du nombre des achats " . $e->getMessage()."</p>";
        return false;
        }

}  

//function pour claculer le total des purchase

function totalPurchases(){

    try{

         $query = $GLOBALS['data']->prepare("SELECT SUM(total_purchase) AS total_purchases FROM purchases WHERE status_id = 5");
            $query->execute();
            $result = $query->fetch();
            if($result){

                return $result;
            }

    } catch(PDOException $e){

        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos des achats" . $e->getMessage()."</p>";
        return false;
    }

}

//==============================================

//function affiche data of purchases


function fetchPurchaseData() {
    $purchase = InnerJoinAllPurchase(); // Appel de la fonction InnerJoinAllPucharse()

    foreach($purchase as $row) {
        $listeProduct[] = $row['name_product'];    // Colonne product
        $listeQuantity[] = $row['quantity_retailPurchase'];  // Colonne quantity
    }

    // Retourner les deux listes sous forme de tableau associatif
    return [
        'products' => $listeProduct,
        'quantities' => $listeQuantity
    ];

}
?>

