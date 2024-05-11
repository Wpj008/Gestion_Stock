<?php
include "data.php";

//FONCTION POUR SECURISER LES FORMULAIRES

function securite($donnee){

    $donnee = trim($donnee);
    $donnee = strip_tags($donnee);
    $donnee = stripcslashes($donnee);

    return $donnee;
}

//CONDITION VALIDATION

/*if (
    !isset($_POST['email'])
    ||empty($_POST['nom'])
    || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo('Il faut un email valides pour soumettre le formulaire.');
    return;
}*/


use function PHPSTORM_META\type;

    $nom = securite($_POST["nom"]); 
    $email = ($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    //$fonction = $_POST["fonction"];
    
    try{
        //On se connecte à la BDD
        //$dbco = new PDO("mysql:host=localhost;dbname=gestionstock","root","");
        //$data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $data->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)");

    
        //On insère les données reçues
        $query->bindParam(':nom', $nom);
        $query->bindParam(':email', $email);
        $query->bindParam(':mot_de_passe', $password);

        // Exécution de la requête
        $query->execute();

        // Confirmation de l'inscription
        echo "Inscription réussie !";
        
    }
    catch(PDOException $e){
        echo ' Erreur inscription : '.$e->getMessage();
    }
?>












<!DOCTYPE htmlL>

          <html lang="fr">
                 <head>
                     <meta charset="utf-8">
                     <title></title>
                     <link href="Creation_Compte.css" rel="stylesheet"> 

                 </head>

            <body>

                <p>
                    <h1>Bienvenu à vous ! </h1><br>


                   <h2> veillez créer votre compte !</h2><br><br>

                        <h3>Complètez vos identités</h3>

                </p>
                <br><br>
        




<form method="post" action="">
                    
                        
                    <fieldset>

                        <div class="password"> 

                       <label for="nom">Nom  : </label>
                        <input  type="text" id="nom" name="nom" autofocus required><?php /*if ( isset($_GET['nom'])){  echo htmlentities($_GET['identifiant']);}*/?><br><br>
                   
                        <label for="Mot de passe">Mot de passe : </label>
                        <input   type="password" id="password" name="password" autofocus required><?php  //if(isset($_GET['Mot de passe'])){ echo htmlentities($_GET['Mot de passe']);}?><br><br>

                    </div>
                    
                    </fieldset><br><br>

                        
                    

                    

                <br><br>

                   <fieldset>

                    <div class="adresse">
                        
                        <ul>
                        <label for="email">email : </label>
                        <input  type="email" id="email" name="email" placeholder="abcemail@gmail.com" autofocus required><?php // echo($_POST['email']); ?><br><br>

        <label for="fonction">Quelle est votre fonction ?</label><br><br>

        <select name="fonction" id="fonction">


            <option value="acheteur">acheteur</option>
            <option value="vendeur">vendeur</option>
        
        </select>
    
                        
                        

                    </ul>

                </div>
                    </fieldset><br><br>

                    <div class="retour">
                    
                    <input type="submit" value="créer compte">

                    </div>


                    




                </form>


              </body>
 
           
           
           


</html>