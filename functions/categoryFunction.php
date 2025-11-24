<?php
include __DIR__."/../data.php";

function registerCategory($nameCategory, $categoryDescription){

    if(empty($nameCategory) || empty($categoryDescription)){

        return "Tous les champs sont requis.";
    }

    try{

    $query = $GLOBALS['data']->prepare("INSERT INTO categories (name_category, category_description) VALUES (:name_category, :category_description)");
    
    
    $query->bindParam(':name_category', $nameCategory);
    $query->bindParam(':category_description', $categoryDescription);


    
    $query->execute(); 

    return "Categorie enregistré !";

    } catch (PDOException $e) {
        return "Erreur d'inscription : " . $e->getMessage();
         }



}

function selectAllCategory(){


   

    try{
    
    $query = $GLOBALS['data']->prepare("SELECT * FROM categories " );
    
    $query->execute();
      
    $category = $query->fetchAll();
    
    if($category){
    
        return $category;
    }
    
    
    } catch(PDOException $e){
    
        return "Il y a eu un probleme de la recuperation des infos de la categorie" . $e->getMessage();
    }
    
    
    
}



?>