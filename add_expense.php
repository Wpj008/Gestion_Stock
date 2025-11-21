<?php
session_start();
include "data.php";
include "header.php";
include "functions/userFunction.php";

$checkLog = checkLogin();//check connection

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_expense.css">
    <title>Depenses</title>
</head>
<body>
    

<div class="expense-container">

    <!-- Header -->
    <div class="expense-header">
        <h1>Gestion des Dépenses</h1>
        <button class="btn-add">+ Ajouter une Dépense</button>
    </div>

    <!-- Tableau -->
    <div class="expense-table">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Catégorie</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Mode de paiement</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>Loyer</td>
                    <td>800.00 €</td>
                    <td>01/02/2025</td>
                    <td>Virement</td>
                    <td>Paiement mensuel bureau</td>
                    <td>
                        <button class="btn small edit">Modifier</button>
                        <button class="btn small delete">Supprimer</button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Électricité</td>
                    <td>120.00 €</td>
                    <td>03/02/2025</td>
                    <td>Espèces</td>
                    <td>Facture mensuelle énergie</td>
                    <td>
                        <button class="btn small edit">Modifier</button>
                        <button class="btn small delete">Supprimer</button>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

    <!-- Formulaire -->
    <div class="expense-form">

        <h2>Ajouter / Modifier une Dépense</h2>

        <form>
            <div class="form-grid">

                <div class="form-group">
                    <label>Catégorie</label>
                    <input type="text" placeholder="Loyer, Électricité...">
                </div>

                <div class="form-group">
                    <label>Montant</label>
                    <input type="number" placeholder="0.00">
                </div>

                <div class="form-group">
                    <label>Date</label>
                    <input type="date">
                </div>

                <div class="form-group">
                    <label>Mode de paiement</label>
                    <select>
                        <option>Espèces</option>
                        <option>Carte Bancaire</option>
                        <option>Mobile Money</option>
                        <option>Virement</option>
                        <option>Chèque</option>
                    </select>
                </div>

            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea placeholder="Détails de la dépense"></textarea>
            </div>

            <button class="btn-save">Enregistrer</button>

        </form>
    </div>

</div>


</body>
</html>