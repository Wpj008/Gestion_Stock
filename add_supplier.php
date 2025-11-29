<?php
session_start();
include "data.php";
include "functions/supplierFunction.php";
include "header.php";
include "functions/userFunction.php";

$checkLog = checkLogin();//check connection

$callSupplier = selectAllSuppliers();

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

$nameSupplier = htmlspecialchars($_POST['name_supplier']);
$emailSupplier = htmlspecialchars($_POST['email_supplier']);
$phoneSupplier = htmlspecialchars($_POST['phone_supplier']);
$supplierAddress = htmlspecialchars($_POST['address_supplier']);


$suppliers = registerSupplier($nameSupplier,$emailSupplier, $phoneSupplier, $supplierAddress);

echo $suppliers;




}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_supplier.css">
    <title>Fournisseur</title>
</head>
<body>
    
<div class="supplier-container">

    <!-- Titre + bouton -->
    <div class="supplier-header">
        <h1>Gestion des Fournisseurs</h1>
    </div>

    <!-- Tableau des fournisseurs -->
    <div class="supplier-table">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php  $i = 0;
            
            foreach ($callSupplier as $suppli) {
                
                $i++?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $suppli['name_supplier']  ?></td>
                    <td><?= $suppli['email_supplier']  ?></td>
                    <td><?= $suppli['phone_supplier']  ?></td>
                    <td><?= $suppli['address_supplier']  ?></td>
                    <td><span class="badge success">Actif</span></td>
                    <td>
                        <button class="btn small edit">Modifier</button>
                        <button class="btn small delete">Supprimer</button>
                    </td>
                </tr>

                <?php } ?>

                <tr>
                    <td>2</td>
                    <td>Global Hardware</td>
                    <td>info@ghardware.com</td>
                    <td>+33 1 78 22 45 12</td>
                    <td>45 Avenue République, Lyon</td>
                    <td><span class="badge inactive">Inactif</span></td>
                    <td>
                        <button class="btn small edit">Modifier</button>
                        <button class="btn small delete">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Formulaire Fournisseur -->
    <div class="supplier-form">
        <h2>Ajouter / Modifier un Fournisseur</h2>

        <div class="border-form">
        
        <form method="POST" action="">
            <div class="form-grid">
                
                <div class="form-group">
                    <label>Nom du Fournisseur</label>
                    <input name="name_supplier" id="name_supplier" type="text" placeholder="Nom complet">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input name="email_supplier" id="email_supplier" type="email" placeholder="exemple@mail.com">
                </div>

                <div class="form-group">
                    <label>Téléphone</label>
                    <input name="phone_supplier"  id="phone_supplier" type="text" placeholder="+33 ...">
                </div>

                <div class="form-group">
                    <label>Adresse</label>
                    <input name="address_supplier" id="address_supplier" type="text" placeholder="Adresse complète">
                </div>

              

                <div class="form-group">
                    <label>Statut</label>
                    <select>
                        <option>Actif</option>
                        <option>Inactif</option>
                    </select>
                </div>

            </div>

            <input class="btn-save" type="submit" name="submit" value="Enregistrer">
         </form>

        </div>
    </div>

</div>


</body>
</html>

<?php
include "footer.php";
?>