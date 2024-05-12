<?php
require 'fonction.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

        // Récupération et nettoyage des données du formulaire
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $type = htmlspecialchars($_POST['type']);
    
        // Appel à la fonction d'inscription
        $result = inscrireUtilisateur($nom, $email, $password, $type);
        echo $result;
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
        




<form method="POST" action="">
                    
                        
                    <fieldset>

                        <div class="password"> 

                       <label for="nom">Nom  : </label>
                        <input  type="text" id="nom" name="nom" autofocus required><br><br>
                   
                        <label for="Mot de passe">Mot de passe : </label>
                        <input   type="password" id="password" name="password" autofocus required><br><br>

                    </div>
                    
                    </fieldset><br><br>

                        
                    

                    

                <br><br>

                   <fieldset>

                    <div class="adresse">
                        
                        <ul>
                        <label for="email">email : </label>
                        <input  type="email" id="email" name="email" placeholder="abcemail@gmail.com" autofocus required><br><br>

        <label for="fonction">Quelle est votre fonction ?</label><br><br>

        <select name="type" id="type">
            <option value="acheteur">acheteur</option>
            <option value="vendeur">vendeur</option>
        </select>


                    </ul>

                </div>
                    </fieldset><br><br>

                    <div class="retour">
                    
                    <input type="submit" name="submit" value="créer compte">

                    </div>


                    




                </form>


              </body>
 
           
           
           


</html>