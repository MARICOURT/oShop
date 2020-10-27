# Projet _Dans les shoe_

## Description

Le nom de code du projet est pour l'instant : **oShop**.

C'est une boutique en ligne de chaussures.  
Oui, il y a déjà beaucoup de concurrence sur le marché, mais nous sommes un groupement de plusieurs marques de chaussures qui ne sont pas encore présentes sur internet.  Et nous ne souhaitons pas dépendre d'une autre société comme Sarenza ou ses concurrents.

### Sur toutes les pages

En bas de chaque page, il y aura :

- le nom de la boutique
- le slogan
- les liens vers les pages de la boutique sur les réseaux sociaux
- 5 types de produits
- 5 marques de produits
- la mise en avant que la livraison et les retours sont gratuits, que les clients ont 30 jours pour renvoyer leur produit, que les internautes peuvent nous contacter au numéro du service client : 01 02 03 04 05 de 8h à 19h, du lundi au vendredi
- un formulaire d'inscription à la newsletter

### Catalogue

Voici le contenu du site prévu pour l'instant :

- une page d'accueil (avec 5 catégories mises en avant)
- une page des produits pour chaque catégorie (détente, en ville, pour le sport)
- une page produit
- une page des produits pour chaque type de produits (chaussons, escarpins, talons aiguilles)
- une page des produits pour chaque marque

### Panier

- les produits pourront être ajoutés au panier depuis la liste de produits de la page "catégorie" et depuis la page du produit
- un résumé du panier dans l'entête
- une page panier (accessible depuis le résumé)

### Commande

- après avoir cliqué sur le bouton "Valider ma commande" présent sur la page panier
- le client se connecte à son compte client ou s'inscrit
- sur une seule page, il renseigne :
  - adresse de facturation
  - adresse de livraison
  - choix de la méthode livraison
  - méthode de paiement
- puis il arrive sur un résumé de sa commande affichant :
  - les informations de la page précédente
  - le contenu du panier
  - un bouton de paiement amenant sur notre prestataire de paiement en ligne sécurisé
- au retour du paiement en ligne,
  - si le paiement est accepté, on affiche la page de confirmation de commande
  - sinon, on affiche la page de commande annulée avec la possibilité de revenir en arrière (au choix du paiement)

### BackOffice

- nécessite de se connecter avec son compte
- les échanges entre le navigateur et le serveur Web sont cryptés par soucis de confidentialité
- gestion des catégories (liste, ajout, modification, suppression)
- gestion des produits (liste, ajout, modification, suppression)
- gestion des types de produits (liste, ajout, modification, suppression)
- gestion des marques (liste, ajout, modification, suppression)
- gestion des commandes (liste + changement du statut payé-envoyé-annulé-retourné)
- gestion des 5 catégories en page d'accueil
- gestion des 5 types de produits en bas de page
- gestion des 5 marques en bas de page
- gestion des utilisateurs du BackOffice
- 3 types d'utilisateurs :
  - `catalog manager` pouvant gérer les données sur les produits du site (y compris catégories, types et marque)
  - `admin` pouvant, en plus du `catalog manager`, modifier le statut des commandes
  - `superadmin` pouvant, en plus de `admin`, modifier le statut des commandes et créer des utilisateurs

## Fichiers techniques

- [User stories](docs/user_stories.md)
- [Product backlog](docs/product_backlog.md)
- [Intégration HTML/CSS](docs/html-css/)