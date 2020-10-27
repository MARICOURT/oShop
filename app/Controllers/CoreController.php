<?php

namespace App\Controllers;

abstract class CoreController {


    // méthodes abstraites
    abstract public function add();
    abstract public function list();
    abstract public function update($id);
    abstract public function delete($id);

    // se déclenche à chaque instanciation d'un contrôleur
    // => endroit idéal pour vérifier que l'action qu'on tente de réalisé nous est autorisée
    public function __construct()
    {
        // récupérer l'action à faire => le nom de la route
        global $match;
        $currentRoute = $match['name'];

        // inclure l'acl
        // ACL = Acces Control List
        // à partir de ce require, on récupère la liste d'accès dans la variable $controlList
        require __DIR__ . '/../acl.php';
        
        // si la route est présente dans la liste des routes pour lesquelles on prévoit un contrôle
        if (array_key_exists($currentRoute, $controlList)){
            // on lance checkAuthorization();
            $this->checkAuthorization($controlList[$currentRoute]);
        }

        // gestion du token CSRF
        // lister routes qui fait une action sensible (suppression, insertion...)
        $csrfTokenToCheckInGet = [
            'category-delete',
            'user-delete',
            'product-delete'
        ];

        // routes qui gèrent les routes POST avec des actions sensibles 
        $csrfTokenToCheckInPost = [
            'category-addpost',
            'category-updatepost',
            'user-addpost',
            'user-updatepost',
            'product-addpost',
            'product-updatepost',
            'main-home-categoriespost'
        ];

        // si la méthode est dans la liste des actions à protéger contre la faille CSRF, on vérifie le token
        // d'abord GET
        if (in_array($currentRoute, $csrfTokenToCheckInGet)) {
            // la route courante est à proteger des attaques CSRF
            if ($_GET['csrf-token'] !== $_SESSION['csrf-token']) {
                http_response_code(403);
                exit('Dégage, pirate. Tu vas tâter de mon épée.');
            };
        }

        // ensuite POST
        if (in_array($currentRoute, $csrfTokenToCheckInPost)) {
            // la route courante est à proteger des attaques CSRF
            if ($_POST['csrf-token'] !== $_SESSION['csrf-token']) {
                http_response_code(403);
                exit('Attention, un pirate ! Tous à vos POST ! Tu vas tâter de mon épée.');
            };
        }
    }

    /**
     * Vérifier que le rôle de l'utilisateur connecté est dans la liste des rôles autorisés
     * En cas d'interdiction => arrêter PHP avec un code HTTP 403
     * 
     * @return bool
     */
    protected function checkAuthorization($roles = [])
    {
        global $router;

        // si user connecté
        if (isset($_SESSION['userId']) && isset($_SESSION['userObject'])) {
            // est-ce que son rôle lui donne accès à cette page ?
            // => est-ce que le rôle de l'user connecté est présent dans la liste des rôles fournis en paramètres ?
            if (in_array($_SESSION['userObject']->getRole(), $roles)) {
                // renvoi true
                return true;
            } else {
                // si non => arrêter PHP avec un code HTTP 403
                http_response_code(403);
                exit();
            }
        }
        // si pas connecté
        else {
            // redirection vers le formulaire de login
            header('Location: ' . $router->generate('user-login'));
        }
    }

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewVars = []) {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        // Comme $viewVars est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewVars['currentPage'] = $viewName; 

        // définir l'url absolue pour nos assets
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . '/assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        if (isset($_SESSION['flashMessages'])) {
            // si on a des messages flash, on les récupère
            $viewVars['flashMessages'] = $_SESSION['flashMessages'];
            // on les supprime de la session grâce à unset()
            // => unset() détruit une variable (ou une clé de tableau)
            // /!\ penser à ne pas unset $_SESSION => sinon déco utilisateur
            unset($_SESSION['flashMessages']);
        } else {
            $viewVars['flashMessages'] = [];
        }
        
        // on génère un token CSRF si inexistant
        if (!isset($_SESSION['csrf-token'])) {
            $viewVars['csrfToken'] = bin2hex(random_bytes(32));
            $_SESSION['csrf-token'] = $viewVars['csrfToken'];
        } else {
            $viewVars['csrfToken'] = $_SESSION['csrf-token'];
        }

        // On veut désormais accéder aux données de $viewVars, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewVars);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }
}
