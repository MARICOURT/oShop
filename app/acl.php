<?php

// définir quel rôle est attribué à chaque route (liste)
// On liste les routes pour lesquelles il faut un contrôle => nom de la route en clé
// Pour chaque route, on donne la liste des rôles qui peuvent y accéder => en valeur
// dans cette liste on ne place pas les routes pour lesquelles on ne veut pas de contrôle (par ex. user-login qui doit être complètement publique)
$controlList = [
    'user-add' => ['admin'],
    'user-list' => ['admin'],
    'user-addpost' => ['admin'],
    'user-update' => ['admin'],
    'user-updatepost' => ['admin'],
    'user-delete' => ['admin'],
    'category-add' => ['admin', 'catalog-manager'],
    'category-addpost' => ['admin', 'catalog-manager'],
    'category-list' => ['admin', 'catalog-manager'],
    'category-update' => ['admin', 'catalog-manager'],
    'category-updatepost' => ['admin', 'catalog-manager'],
    'category-delete' => ['admin', 'catalog-manager'],
    'product-add' => ['admin', 'catalog-manager'],
    'product-addpost' => ['admin', 'catalog-manager'],
    'product-list' => ['admin', 'catalog-manager'],
    'product-update' => ['admin', 'catalog-manager'],
    'product-updatepost' => ['admin', 'catalog-manager'],
    'product-delete' => ['admin', 'catalog-manager'],
    'main-home' => ['admin', 'catalog-manager'],
    'main-home-categories' => ['admin', 'catalog-manager'],
    'main-home-categoriespost' => ['admin', 'catalog-manager'],
];