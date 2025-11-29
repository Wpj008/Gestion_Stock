<?php
session_start();
include "data.php";
include "header.php";
include "functions/userFunction.php";


$checkLog = checkLogin();//check connection

$callUser = selectAllUser();


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_setting.css">
    <title>Paramètre</title>
</head>
<body>

<div class="settings-container">

    <h1>Paramètres du Système</h1>

    <!-- Informations entreprise -->
    <div class="settings-box">
        <h2>Informations de l'entreprise</h2>

        <!-- FORMULAIRE 1 -->
        <form class="form-grid" id="form-company">

            <div class="form-group">
                <label>Nom de l'entreprise</label>
                <input type="text" placeholder="Ex : TechPlus SARL" name="company_name">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="contact@mail.com" name="company_email">
            </div>

            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" placeholder="+33 ..." name="company_phone">
            </div>

            <div class="form-group">
                <label>Adresse</label>
                <input type="text" placeholder="Adresse complète" name="company_address">
            </div>

            <div class="form-group">
                <label>Devise</label>
                <select name="company_currency">
                    <option>€ Euro</option>
                    <option>$ Dollar</option>
                    <option>FCFA</option>
                </select>
            </div>

            <div class="form-group">
                <label>Numéro d'identification (RC, NIF…)</label>
                <input type="text" placeholder="Ex : NIF 10293847" name="company_id">
            </div>

            <div class="form-group">
                <label>Logo</label>
                <input type="file" name="company_logo">
            </div>

            <button class="btn-save" type="submit">Enregistrer</button>
        </form>

    </div>


    <!-- UTILISATEURS -->
    <div class="settings-box">
        <h2>Gestion des utilisateurs</h2>

        <table class="settings-table">
            <thead>

            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php 
            $i = 0;            
            foreach($callUser as $user){
                
                $i++; ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $user['name_user'] ?></td>
                <td><?= $user['email_user'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <button class="btn small edit">Modifier</button>
                    <button class="btn small delete">Supprimer</button>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>

        <!-- FORMULAIRE 2 : Ajouter Utilisateur -->
        <h3>Ajouter un utilisateur</h3>

        <form class="form-grid" id="form-user-add">

            <div class="form-group">
                <label>Nom complet</label>
                <input type="text" placeholder="Ex : Jean Dupont" name="user_name">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="user@mail.com" name="user_email">
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" placeholder="********" name="user_password">
            </div>

            <div class="form-group">
                <label>Rôle</label>
                <select name="user_role">
                    <option>Administrateur</option>
                    <option>Collaborateur</option>
                </select>
            </div>

            <button class="btn-save" type="submit">Ajouter</button>

        </form>

    </div>


    <!-- Paramètres généraux -->
    <div class="settings-box">
        <h2>Paramètres généraux</h2>

        <!-- FORMULAIRE 3 -->
        <form class="form-grid" id="form-general">

            <div class="form-group">
                <label>TVA (%)</label>
                <input type="number" placeholder="Ex : 20" name="tva">
            </div>

            <div class="form-group">
                <label>Langue</label>
                <select name="language">
                    <option>Français</option>
                    <option>Anglais</option>
                </select>
            </div>

            <div class="form-group">
                <label>Format de date</label>
                <select name="date_format">
                    <option>JJ/MM/AAAA</option>
                    <option>MM/JJ/AAAA</option>
                </select>
            </div>

            <div class="form-group">
                <label>Fuseau horaire</label>
                <select name="timezone">
                    <option>Europe/Paris</option>
                    <option>Africa/Abidjan</option>
                    <option>Africa/Dakar</option>
                </select>
            </div>

            <button class="btn-save" type="submit">Enregistrer</button>

        </form>
    </div>

</div>

</body>
</html>
