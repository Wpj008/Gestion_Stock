<?php
session_start();
include "data.php";
include "header.php";

$idUser = $_SESSION['id_user'] ;


//Jointure des tables produits et commandes et affichage de l'historique de commande

$query = $data->prepare("SELECT * FROM produits INNER JOIN commandes ON produits.id = commandes.produit_id WHERE utilisateur_id = :id");

$query->bindParam(':id',$idUser );

 $query->execute();
 $results = $query->fetchAll();


 //Affichage du nombre total de commande effectuée selon id_user

 $query = $data->prepare("SELECT COUNT(*) AS total FROM commandes WHERE utilisateur_id = :id ");

 $query->bindParam(':id', $idUser);

 $query->execute();

 $valeur = $query->fetch();
/* 
echo "quantité commandé : ".$commande."<br>";
 echo "Prix total : ". $totalPrix."$"."<br>"; 
*/



//Verification de l'existance de la variable de session et affichage du contenu

if ($results) {

    echo "<table>"; 
    echo "<tr><th>Nom du produit</th><th>Info sur le produit</th><th>Date de commande</th><th>Etat de la commande</th></tr>"; 

    
    foreach ($results as $result) {
      

        echo "<tr>";

     //  echo "<td>" . $i++ . "</td>"; 
        
        echo "<td>" . $result['nom'] . "</td>"; 
       

       echo "<td>" . $result['description'] . "</td>";

       echo "<td>" . $result['date_commande'] . "</td>";

       echo "<td>" . $result['etat_id'] . "</td>";


       echo "</tr>";
;


      }  echo "</table>";

   }else {
    echo "Aucune commande à afficher.";
}


       echo "Total des commandes effectuées : " . $valeur['total'];


















?>