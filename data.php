<?php

$host = 'localhost';
$dbname = 'inventorymanagement';
$user = 'root';
$password = '';

try{
$data = new PDO("mysql:host=$host; dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>