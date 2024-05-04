<?php
include "data.php";

use function PHPSTORM_META\type;

    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
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
        
        <?php /*
            echo 'nom : '.$_POST["nom"].'<br>';
            echo 'Email : ' .$_POST["email"].'<br>';
            echo 'Mot de passe : ' .$_POST["Mot de passe"].'<br>';
            echo 'fonction : ' .$_POST["fonction"].'<br>';*/
        ?>




<form method="post" action="">
                    
                        
                    <fieldset>

                        <div class="password"> 

                       <label for="nom">Nom  : </label>
                        <input  type="text" id="nom" name="nom" autofocus required><?php  //if(isset($_GET['identifiant'])){ echo htmlentities($_GET['identifiant']);}?><br><br>
                   
                        <label for="Mot de passe">Mot de passe : </label>
                        <input   type="password" id="password" name="password" autofocus required><?php  //if(isset($_GET['Mot de passe'])){ echo htmlentities($_GET['Mot de passe']);}?><br><br>

                    </div>
                    
                    </fieldset><br><br>

                        
                    

                    

                <br><br>

                   <fieldset>

                    <div class="adresse">
                        
                        <ul>
                        <label for="email">email : </label>
                        <input  type="email" id="email" name="email" placeholder="abcemail@gmail.com" autofocus required><?php //  if(isset($_GET['email'])){ echo htmlentities($_GET['email']);}?><br><br>
                            <p>FONCTION : </p>
                        <input type="radio" name="fonction" id="fonction" value="fonction">
                        <label for="fonction">Acheteur</label><br><br>
                        <input type="radio" name="fonction" id="fonction" value="fonction">
                        <label for="fonction">Vendeur</label><br><br>
                        
                        

                    </ul>

                </div>
                    </fieldset><br><br>

                    <div class="retour">
                    
                    <input type="submit" value="créer compte">

                    </div>


                    




                </form>


              </body>
 
           
           
           


</html>