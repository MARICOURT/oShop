<?php

namespace App\Controllers;

// Si j'ai besoin du Model Category
use App\Models\Category;

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home');
    }
    
    public function homeCategories()
    {
        // récupérer les catégories à placer en option des <select>
        $categoryList = Category::findAll();

        $this->show('main/home_categories', ['categoryList' => $categoryList]);
    }

    public function homeCategoriesPost()
    {
        global $router; 
        
        // valider les données reçues
        if (!filter_input_array(INPUT_POST, ['emplacement' => FILTER_VALIDATE_INT])) {
            // gérer l'affichage d'une erreur
            
            // redirection vers le formulaire
            
            exit('Erreur données');
        }

        // on a obtenu en POST une liste d'id de category (dans un array indexé à 0)
        $emplacement = $_POST['emplacement'];


        // mettre à zéro le champ home_order de toutes les catégories
        // => prévoir une nouvelle méthode de Model
        $homeOrderReset = Category::resetAllHomeOrder();

        if ($homeOrderReset) {
            // on veut update les catégories => mettre à jour le champ home_order des catégories concernées
            
            foreach ($emplacement as $homeOrder => $categoryId) {

                // si on a pas de valeur pour $categoryId (un <select> n'a pas remonté de valeur => choix vide)
                if (empty($categoryId)) {
                    // on saute immédiatement au tour de boucle suivant
                    continue;
                }

                // home order doit être incrémenté pour correspondre à une valeur utilisable pour le champ home_order
                $homeOrder++;

                // charger le model de la catégorie courante
                $currentCategory = Category::find($categoryId);
                // modifier la valeur de home order pour cette catégorie
                $currentCategory->setHomeOrder($homeOrder);
                // sauvegarder le modèle en BDD
                $currentCategory->save();
            }
        }
        

        // rediriger vers le formulaire de gestion de la home
        header('Location:' . $router->generate('main-home-categories'));

        exit(); 
    }


    public function add() {}
    public function list() {}
    public function update($id) {}
    public function delete($id) {}
}
