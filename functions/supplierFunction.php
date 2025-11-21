<?php
include "data.php";

function registerSupplier($nameSupplier,$emailSupplier, $phoneSupplier, $supplierAddress){

    if(empty($nameSupplier) || empty($emailSupplier)|| empty($phoneSupplier)|| empty($supplierAddress)){

        return "Tous les champs sont requis.";
    }

    try{

    $query = $GLOBALS['data']->prepare("INSERT INTO suppliers (name_supplier, email_supplier, phone_supplier, address_supplier) VALUES (:name_supplier,:email_supplier, :phone_supplier, :address_supplier)");
    
    
    $query->bindParam(':name_supplier', $nameSupplier);
    $query->bindParam(':email_supplier', $emailSupplier);
    $query->bindParam(':phone_supplier', $phoneSupplier);
    $query->bindParam(':address_supplier', $supplierAddress);


    
    $query->execute(); 

    return "Fournisseur enregistré !";

    } catch (PDOException $e) {
        return "Erreur d'inscription : " . $e->getMessage();
         }



}

function selectAllSupplier(){


   

    try{
    
    $query = $GLOBALS['data']->prepare("SELECT * FROM suppliers " );
    
    $query->execute();
      
    $supplier = $query->fetchAll();
    
    if($supplier){
    
        return $supplier;
    }
    
    
    } catch(PDOException $e){
    
        return "Il y a eu un probleme de la recuperation des infos de la categorie" . $e->getMessage();
    }
    
    
    
}


?>