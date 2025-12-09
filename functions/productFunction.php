<?php
include __DIR__."/../data.php";

//function pour afficher all products + requete de jointure entre product, category  and supplier
function selectAllProduct(){

    try{

     $query = $GLOBALS['data']->prepare("SELECT * FROM categories INNER JOIN products ON categories.id_category = products.category_id INNER JOIN suppliers ON suppliers.id_supplier = products.supplier_id");


$query->execute();
  
$produits = $query->fetchAll();

if($produits){

    return $produits;
}


} catch(PDOException $e){

    echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos des produits" . $e->getMessage()."</p>";
    return;
}


}

//function affiche all category

function selectAllCategory(){

    try{

    $query = $GLOBALS['data']->prepare("SELECT * FROM categories " );

$query->execute();
  
$category = $query->fetchAll();

if($category){

    return $category;
}


} catch(PDOException $e){

    echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos des catégories" . $e->getMessage()."</p>";
    return;
}


}

//function affiche all supplier

function selectAllSupplier(){

    try{

    $query = $GLOBALS['data']->prepare("SELECT * FROM suppliers " );

$query->execute();
  
$supplier = $query->fetchAll();

if($supplier){

    return $supplier;
}


} catch(PDOException $e){

    echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos des fournisseurs" . $e->getMessage()."</p>";
    return;
}


}

//function d'ajout de produit dans la bdd

function registerProduct( $name, $supplier, $quantity, $description, $priceSALe, $pricePurchase, $picture, $category, $etat_produit){


    // Testons si le fichier a bien été envoyé et s'il n'y a pas des erreurs
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        // Testons, si le fichier est trop volumineux
        if ($_FILES['image']['size'] > 1000000) {
            $errormessage = "L'envoi n'a pas pu être effectué, erreur ou image trop volumineuse";
    
            echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
            return;
        }
        // Testons, si l'extension n'est pas autorisée
        $fileInfo = pathinfo($_FILES['image']['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = [ 'jpg','jpeg', 'gif', 'png'];
        if (!in_array($extension, $allowedExtensions)) {
            $errormessage = "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée";
    
            echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
            return;
        }
        // Testons, si le dossier uploads est manquant
        $path ='img/';
        if (!is_dir($path)) {
            $errormessage = "L'envoi n'a pas pu être effectué, le dossier uploads est manquant";
    
            echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
            return;
        }
    
        //Verification de tous les champs
    
        if (!empty($name === "" || $description === "" || $quantity === "" || $priceSALe === "" || $pricePurchase === "")) {
            $errormessage = "Veuillez remplir tous les champs ";
    
            echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
            return;
            
        }
    
        if($quantity <= 0 || $priceSALe <= 0 || $pricePurchase <= 0){
    
            $errormessage = "La quantité ou le prix ne peut pas être inferieure ou égale à 0";
    
            echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
            return;
        
        }
    
        // Déplacez le fichier dans le répertoire de destination
        $destination = $path . basename($_FILES['image']['name']);
    
        $picture = $destination;
    
    //Insertion des données saisies par l'user dans la bdd dans la table produit
    
    $query = $GLOBALS['data']->prepare("INSERT INTO products (name_product, category_id, supplier_id, quantity_product, product_description, price_product_sale, price_product_purchase, picture_product, product_status) VALUES (:name, :category, :supplier, :quantity, :description, :priceSale, :pricePurchase , :image, :etat_produit)");
    $query->bindParam(':name', $name);
    $query->bindParam(':category', $category);
    $query->bindParam(':supplier', $supplier);
    $query->bindParam(':quantity', $quantity);
    $query->bindParam(':description', $description);
    $query->bindParam(':priceSale', $priceSALe);
    $query->bindParam(':pricePurchase', $pricePurchase);
    $query->bindParam(':etat_produit', $etat_produit);
    $query->bindParam(':image', $picture);

    
    $query->execute(); 
    
    
    
    
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            echo "<p style='color:green;'>Le fichier a été téléchargé avec succès."."</p>";
        } else {
            echo "<p style='color:red;'>Échec du téléchargement du fichier."."</p>";
        }
    } else {
        echo "<p style='color:red;'>Aucun fichier ou une erreur est survenue lors du téléchargement."."</p>";
    }
    
    
    }

?>