<?php
include __DIR__."/../data.php";

function registerCategory($nameCategory, $categoryDescription){

    if(empty($nameCategory) || empty($categoryDescription)){

        echo "<p style='color:red;'>.Tous les champs sont requis."."</p>";
        return;
    }

    try{

    $query = $GLOBALS['data']->prepare("INSERT INTO categories (name_category, category_description) VALUES (:name_category, :category_description)");
    
    
    $query->bindParam(':name_category', $nameCategory);
    $query->bindParam(':category_description', $categoryDescription);


    
    $query->execute(); 

    echo "<p style='color:green;'>Categorie enregistré !"."</p>";
        return;

    } catch (PDOException $e) {
        echo "<p style='color:red;'> Erreur d'inscription : " . $e->getMessage()."</p>";
            return;
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
    
        echo "<p style='color:red;'>Il y a eu un probleme de la recuperation des infos de la categorie" . $e->getMessage()."</p>";
        return;
    }
    
    
    
}



?>