<?php
include __DIR__."/../data.php";

function registerSupplier($nameSupplier,$emailSupplier, $phoneSupplier, $supplierAddress){

    if(empty($nameSupplier) || empty($emailSupplier)|| empty($phoneSupplier)|| empty($supplierAddress)){

        echo "<p style='color:red;'>Tous les champs sont requis."."</p>";
        return;
    }

    try{

    $query = $GLOBALS['data']->prepare("INSERT INTO suppliers (name_supplier, email_supplier, phone_supplier, address_supplier) VALUES (:name_supplier,:email_supplier, :phone_supplier, :address_supplier)");
    
    
    $query->bindParam(':name_supplier', $nameSupplier);
    $query->bindParam(':email_supplier', $emailSupplier);
    $query->bindParam(':phone_supplier', $phoneSupplier);
    $query->bindParam(':address_supplier', $supplierAddress);


    
    $query->execute(); 

    echo "<p style='color:green;'>Fournisseur enregistré !"."</p>";
        return;

    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erreur d'inscription : " . $e->getMessage()."</p>";
            return;
         }



}

function selectAllSuppliers(){


   

    try{
    
    $query = $GLOBALS['data']->prepare("SELECT * FROM suppliers " );
    
    $query->execute();
      
    $supplier = $query->fetchAll();
    
    if($supplier){
    
        return $supplier;
    }
    
    
    } catch(PDOException $e){
    
        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos de la categorie" . $e->getMessage()."</p>";
        return;
    }
    
    
    
}

//=============================================
//function pour afficher le nombre de suppliers

function countSuppliers(){

    try{

         $query = $GLOBALS['data']->prepare("SELECT COUNT(*) AS valeur FROM suppliers");
            $query->execute();
            $result = $query->fetch();
            if($result){

                return $result;
            }
    } catch(PDOException $e){
        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation du nombre des fournisseurs " . $e->getMessage()."</p>";
        return false;
        }

}

?>