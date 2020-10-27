<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController extends CoreController {

    /**
     * Page de liste des catégories
     * 
     * @return void
     */
    public function list()
    {
        // récupérer les données : toutes les catégories enregistrées
        $categoryList = Category::findAll();

        $this->show('category/list', [
            'categoryList' => $categoryList
        ]);
    }

    /**
     * Page d'ajout d'une catégorie
     * 
     * @return void
     */
    public function add()
    {
        $this->show('category/add');
    }

    /**
     * enregistrement des données du formulaire d'ajout de catégorie
     * 
     * @return void
     */
    public function addPost()
    {
        //beurk, mais très bien pour l'instant
        global $router;

        // ne récupérer les valeurs que si elles existent en POST
        if (filter_input(INPUT_POST, 'name')) {
            $name = $_POST['name'];
        }
        
        if (filter_input(INPUT_POST, 'subtitle')) {
            $subtitle = $_POST['subtitle'];
        }

        if (filter_input(INPUT_POST, 'picture')) {
            $picture = $_POST['picture'];
        }

        // création du model
        $category = new Category();

        $category->setName($name);
        $category->setSubtitle($subtitle);
        $category->setPicture($picture);
        
        // déclencher l'enregistrement en bdd
        // on récupère le succes de l'opération
        $success = $category->save();

        if ($success) {
            // si la requête d'insert a fonctionné
            // redirection vers la page de liste
            $redirect = $router->generate('category-list');
        } else {
            // si la requête d'insert n'a pas fonctionné
            // redirection vers la page d'ajout => on réaffiche le formulaire (avec potentiellement un message d'erreur)
            $redirect = $router->generate('category-add');
        }
        
        header("Location: " . $redirect);
        exit(); // ici exit facultatif, rien ne sera de toute façon exécuté plus loin
    }

    /**
     * Page d'ajout d'une catégorie
     * 
     * @return void
     */
    // Avec AltoDispatcher, on ne récupère plus les parties variables de l'url via le tableau $params mais on récupère maintenant un paramètre par morceau variable de l'url (dans l'ordre d'apparition dans l'url)
    public function update($categoryId)
    {

        // récupérer la catégorie concernée
        $category = Category::find($categoryId);

        $this->show('category/update', [
            'category' => $category
        ]);
    }

    /**
     * enregistrement des données du formulaire de modification de catégorie
     * 
     * @return void
     */
    public function updatePost()
    {

        //beurk, mais très bien pour l'instant
        global $router;

        // ne récupérer les valeurs que si elles existent en POST
        if (filter_input(INPUT_POST, 'id')) {
            $id = $_POST['id'];
        }

        if (filter_input(INPUT_POST, 'name')) {
            $name = $_POST['name'];
        }
        
        if (filter_input(INPUT_POST, 'subtitle')) {
            $subtitle = $_POST['subtitle'];
        }

        if (filter_input(INPUT_POST, 'picture')) {
            $picture = $_POST['picture'];
        }

        // récupérer le model correspondant à l'id de la catégorie modifiée
        $category = Category::find($id);

        $category->setName($name);
        $category->setSubtitle($subtitle);
        $category->setPicture($picture);
        
        // déclencher l'enregistrement en bdd
        // on récupère le succes de l'opération
        $success = $category->save();

        if ($success) {
            // si la requête d'insert a fonctionné
            // redirection vers la page de liste avec un message de succès
            $redirect = $router->generate('category-update', [
                'categoryId' => $id
            ]);
        } else {
            // si la requête d'insert n'a pas fonctionné
            // redirection vers la page d'ajout => on réaffiche le formulaire (avec potentiellement un message d'erreur)
            // en attendant : 
            exit('Erreur d\'insertion');
            $redirect = $router->generate('category-add', [
                'categoryId' => $id
            ]);
        }
        
        header("Location: " . $redirect);
        exit(); // ici exit facultatif, rien ne sera de toute façon exécuté plus loin
    }

    public function delete($categoryId)
    {
        global $router;
        
        // récupérer le model de la catégorie à supprimer
        $category = Category::find($categoryId);

        // faire la suppression
        $success = $category->delete();

        if ($success) {
            // on prépare un message de succes
        } else {
            // on prépare un message d'erreur
        }

        // redirection vers la liste
        header('Location: ' . $router->generate('category-list'));
        exit();
    }
}