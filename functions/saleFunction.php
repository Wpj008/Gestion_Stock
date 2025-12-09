<?php
include __DIR__."/../data.php";


//function pour afficher all products 
function selectAllSale(){

    try{

         $query = $GLOBALS['data']->prepare("SELECT * FROM products");


         $query->execute();
  
         $produits = $query->fetchAll();

         if($produits){

         return $produits;
        }


    }
    catch(PDOException $e){

        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos des produits : " . $e->getMessage()."</p>";
        return;
     }


}

// Enregistre la vente principale
function registerSale($user_id, $status, $total_sale, $payment) {
    try {
        $query = $GLOBALS['data']->prepare(" INSERT INTO sales (user_id, date_sale, status_id, total_sale, payment_method_sale) VALUES (:user_id, NOW(), :status_id, :total_sale, :payment) ");

        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':status_id', $status);
        $query->bindParam(':total_sale', $total_sale);
        $query->bindParam(':payment', $payment);
        $query->execute();

        return $GLOBALS['data']->lastInsertId();
    }
    catch (PDOException $e) {
        echo "<p style='color:red;'>Erreur : " . $e->getMessage()."</p>";
        return;
    }
}


// Enregistre les produits liés à la vente
function registerRetailSale($sale_id, $product_ids, $quantities, $prices) {

    try {

        foreach ($product_ids as $index => $product_id) {

            $quatityCommand = $quantities[$index];
            $price = $prices[$index];
            $total = $quatityCommand * $price;

            // Vérifie que nombre valide
            if (is_numeric($quatityCommand) && $quatityCommand > 0) {

                // Récupération du stock actuel du produit
                $queryStock = $GLOBALS['data']->prepare("SELECT quantity_product FROM products WHERE id_product = :id");
                $queryStock->bindParam(':id', $product_id);
                $queryStock->execute();
                $Stock = $queryStock->fetchColumn();


                //Calcul du nouveau stock
                $newQuantite = $Stock - $quatityCommand;


                //Vérification du stock
                if ($newQuantite >= 0) {

                    // Mise à jour du stock dans la BDD
                    $queryUpdate = $GLOBALS['data']->prepare("UPDATE products SET quantity_product = :quantite WHERE id_product = :id");

                    $queryUpdate->bindParam(':quantite', $newQuantite);
                    $queryUpdate->bindParam(':id', $product_id);
                    $queryUpdate->execute();


                    // Insertion de la ligne dans retail_sales
                    $queryInsert = $GLOBALS['data']->prepare("INSERT INTO retail_sales(sale_id, product_id, quantity_retailSale, unit_price_retailSale, grand_total_retailSale)VALUES (:sale_id, :product_id, :qty, :price, :total)");

                    $queryInsert->bindParam(':sale_id', $sale_id);
                    $queryInsert->bindParam(':product_id', $product_id);
                    $queryInsert->bindParam(':qty', $quatityCommand);
                    $queryInsert->bindParam(':price', $price);
                    $queryInsert->bindParam(':total', $total);

                    $queryInsert->execute();

                    if($newQuantite >= 5 && $newQuantite <= 10){

                        $etat = 6;

                        // Mise à jour du status du produit dans la BDD
                        $queryUpdate = $GLOBALS['data']->prepare("UPDATE products SET product_status = :etat WHERE id_product = :id");
    
                        $queryUpdate->bindParam(':etat', $etat);
                        $queryUpdate->bindParam(':id', $product_id);
                        $queryUpdate->execute();


                    }

                    if($newQuantite >= 0 && $newQuantite < 5){

                        $etat = 7;

                        // Mise à jour du status du produit dans la BDD
                        $queryUpdate = $GLOBALS['data']->prepare("UPDATE products SET product_status = :etat WHERE id_product = :id");
    
                        $queryUpdate->bindParam(':etat', $etat);
                        $queryUpdate->bindParam(':id', $product_id);
                        $queryUpdate->execute();
                    }

                    echo "<p style='color:green;'>Vente enregistrée avec succès.</p>";

                } else {

                    echo "<p style='color:red;'>Quantité insuffisante pour le produit commandé</p>";
                }

            } else {
                echo "<p style='color:red;'>La quantité saisie n'est pas un nombre valide.</p>";
            }
        }

    } catch (PDOException $e) {

        echo "<p style='color:red;'>Erreur produits : " . $e->getMessage()."</p>";
        return;
    }
}


//function de jointure entre tables sales, retail_sale, product

function InnerJoinTableSale(){

    try{

        $query = $GLOBALS['data']->prepare("SELECT * FROM retail_sales INNER JOIN products ON retail_sales.product_id = products.id_product INNER JOIN sales ON retail_sales.sale_id = sales.id_sale INNER JOIN users ON sales.user_id = users.id_user");

        $query->execute();

        $sales = $query->fetchAll();

        if($sales){

        return $sales;
        }




    }
    catch(PDOException $e){
    
        echo "<p style='color:red;'>Erreur lors de la recuperation des informations". $e->getMessage()."</p>";
        return;

        }
}

//==============================================

//function pour afficher le nombre de sales

function countSales(){

    try{

         $query = $GLOBALS['data']->prepare("SELECT COUNT(*) AS total FROM sales");
            $query->execute();
            $result = $query->fetch();
            if($result){

                return $result;
            }

    } catch(PDOException $e){

        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos des ventes" . $e->getMessage()."</p>";
        return;
    }

}


//function pour claculer le total des sales

function totalSales(){

    try{

         $query = $GLOBALS['data']->prepare("SELECT SUM(total_sale) AS total_sales FROM sales");
            $query->execute();
            $result = $query->fetch();
            if($result){

                return $result;
            }

    } catch(PDOException $e){

        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos des ventes" . $e->getMessage()."</p>";
        return;
    }

}

//=============================================

//function affiche data of sales


function fetchSalesData() {
    $sales = InnerJoinTableSale(); // Appel de la fonction InnerJoinTableSale()

    foreach($sales as $row) {
        $listeProduct[] = $row['name_product'];    // Colonne product
        $listeQuantity[] = $row['quantity_retailSale'];  // Colonne quantity
    }

    // Retourner les deux listes sous forme de tableau associatif
    return [
        'products' => $listeProduct,
        'quantities' => $listeQuantity
    ];

}

?>