<?php

// On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
// On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : informations contenant
//      - le nom de la méthode à utiliser pour répondre à cette route
//      - le nom du controller contenant la méthode
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);

// gestion des catégories de l'accueil
$router->map(
    'GET',
    '/home-categories/',
    [
        'method' => 'homeCategories',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home-categories'
);

// prendre en charge les données du formulaire de gestion des catégories de l'accueil
$router->map(
    'POST',
    '/home-categories/',
    [
        'method' => 'homeCategoriesPost',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home-categoriespost'
);

// Formulaire de connexion
$router->map(
    'GET',
    '/user/login/',
    [
        'method' => 'login',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-login'
);

// prise en charge de la soumission du formulaire de connexion
$router->map(
    'POST',
    '/user/login/',
    [
        'method' => 'loginPost',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-loginpost'
);

// déconnexion
$router->map(
    'GET',
    '/user/logout/',
    [
        'method' => 'logout',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-logout'
);

// liste des utilisateurs
$router->map(
    'GET',
    '/user/list/',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-list'
);


// mettre à jour un utilisateur
$router->map(
    'GET',
    '/user/[i:userId]/update/',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-update'
);

// supprimer un utilisateur
$router->map(
    'GET',
    '/user/[i:userId]/delete/',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-delete'
);

// ajouter un utilisateur
$router->map(
    'GET',
    '/user/add/',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-add'
);

// traiter la soumission du formulaire d'ajout d'utilisateur
$router->map(
    'POST',
    '/user/add/',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-addpost'
);

// page de liste des catégories
$router->map(
    'GET',
    '/category/list/',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-list'
);

// page d'ajout d'une catégorie
$router->map(
    'GET',
    '/category/add/',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-add'
);

// prise en charge du formulaire d'ajout d'une catégorie
$router->map(
    'POST',
    '/category/add/',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-addpost'
);

// page de modification d'une catégorie
$router->map(
    'GET',
    '/category/[i:categoryId]/update/',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-update'
);

// prise en charge du formulaire de modification d'une catégorie
$router->map(
    'POST',
    '/category/update/',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-updatepost'
);

// suppression d'une catégorie
$router->map(
    'GET',
    '/category/[i:categoryId]/delete/',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-delete'
);

// page de liste des produits
$router->map(
    'GET',
    '/product/list/',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-list'
);

// page d'ajout d'un produit
$router->map(
    'GET',
    '/product/add/',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-add'
);

// prise en charge du formulaire d'ajout d'un produit
$router->map(
    'POST',
    '/product/add/',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-addpost'
);

// page de modification d'un produit
$router->map(
    'GET',
    '/product/[i:productId]/update/',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-update'
);

// prise en charge du formulaire de modification d'un produit
$router->map(
    'POST',
    '/product/update/',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-updatepost'
);

// suppression d'un produit
$router->map(
    'GET',
    '/product/[i:productId]/delete/',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-delete'
);