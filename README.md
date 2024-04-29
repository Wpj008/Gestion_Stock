# Système de Gestion de Stock

## Description

Ce projet est un système de gestion de stock développé en PHP et MySQL. Il permet aux utilisateurs de se connecter en tant que vendeurs ou acheteurs pour gérer les stocks de produits. Les vendeurs peuvent ajouter ou supprimer des produits, tandis que les acheteurs peuvent passer des commandes.

## Tables de la Base de Données

### `utilisateurs`

- **Description**: Contient les informations des utilisateurs qui peuvent se connecter au système.
- **Colonnes**:
  - `id`: Identifiant unique pour chaque utilisateur.
  - `nom`: Nom de l'utilisateur.
  - `email`: Email de l'utilisateur, doit être unique.
  - `mot_de_passe`: Mot de passe hashé de l'utilisateur pour la connexion.
  - `type`: Type de l'utilisateur (`vendeur` ou `acheteur`).
  - `date_creation`: Date et heure de la création du compte utilisateur.

### `categories`

- **Description**: Catégorise les produits enregistrés dans la base.
- **Colonnes**:
  - `id`: Identifiant unique de la catégorie.
  - `nom`: Nom de la catégorie, unique.
  - `description`: Description plus détaillée de la catégorie.

### `produits`

- **Description**: Contient les détails des produits en stock.
- **Colonnes**:
  - `id`: Identifiant unique pour chaque produit.
  - `nom`: Nom du produit.
  - `quantite`: Quantité en stock du produit.
  - `description`: Description du produit.
  - `date_ajout`: Date de l'ajout du produit au stock.
  - `categorie_id`: Clé étrangère qui référence `categories(id)`.

### `fournisseurs`

- **Description**: Stocke les informations sur les fournisseurs.
- **Colonnes**:
  - `id`: Identifiant unique pour chaque fournisseur.
  - `nom`: Nom du fournisseur.
  - `adresse`: Adresse du fournisseur.
  - `telephone`: Numéro de téléphone du fournisseur.
  - `email`: Email du fournisseur.

### `commandes`

- **Description**: Enregistre les commandes passées par les acheteurs.
- **Colonnes**:
  - `id`: Identifiant unique pour chaque commande.
  - `utilisateur_id`: Clé étrangère qui référence `utilisateurs(id)`.
  - `produit_id`: Clé étrangère qui référence `produits(id)`.
  - `quantite`: Quantité commandée.
  - `date_commande`: Date et heure de la commande.
  - `etat_id`: Clé étrangère qui référence `etats_commande(id)`.

### `etats_commande`

- **Description**: Décrit les différents états possibles d'une commande.
- **Colonnes**:
  - `id`: Identifiant unique pour chaque état.
  - `nom`: Nom de l'état de la commande.
  - `description`: Description de l'état de la commande.

## Relations entre les Tables

- `produits` est lié à `categories` par `categorie_id`.
- `commandes` est liée à `utilisateurs` par `utilisateur_id` et à `produits` par `produit_id`.
- `commandes` utilise également `etats_commande` par `etat_id` pour définir l'état de la commande.

Ce schéma permet une gestion flexible des utilisateurs, produits, fournisseurs, et commandes avec une extension facile pour d'autres fonctionnalités.

