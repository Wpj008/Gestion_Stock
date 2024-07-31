<?php
session_start();
include "data.php";
include "header.php";

$id = $_SESSION['id_user'];




//Recuperations de toutes les informations dans la bdd 

$query = $data->prepare("SELECT * FROM utilisateurs WHERE id = :id_user  " );
$query->bindParam(':id_user', $id);


$query->execute();
  
$users = $query->fetchAll(); 





if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

 
    
        header('Location: password.php');
    
        
    
    }
    

foreach($users as $user){



?>




<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title></title>
<link rel="stylesheet" href="css/dataUser.css">

</head>
<body>




    
    <div class="user-container">
    <h2>Informations de L'utilisateur</h2>
    <div class="user-info">
    <label>Nom :</label>  <?= $user['nom']?><br><br>
    <label>email :</label> <?=$user['email']?> <br><br>
    
    
    <label>Type :</label> <?=$user['type']?><br><br>
    
    

    <br><br><br>


    <form method="POST" action="">

      <button type="submit" name="submit" > Changer Mot de passe </button>

    </form>
    
    
    </div>
    </div>

<?php }?>


</body>
</html>


<?php
include "footer.php";
?>