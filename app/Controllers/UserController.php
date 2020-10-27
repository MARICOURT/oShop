<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController {

    public function update($id) { }
    public function delete($id)  { }
    
    // Afficher le formulaire de connexion
    public function login()
    {
        $this->show('user/login');
    }
    
    // Prendre en charge les données du formulaire de connexion
    // Réaliser la connexion
    public function loginPost()
    {
        global $router; 
        // récupérer les données via $_POST
        // les valider
        if (filter_input(INPUT_POST, 'email')) {
            $email = $_POST['email'];
        }
        
        if (filter_input(INPUT_POST, 'password')) {
            $password = $_POST['password'];
        }
        
        // vérifier que l'utilisateur existe en fonction de l'email saisi dans le formulaire
        // => méthode de model pour récupérer un utilisateur par email
        $user = AppUser::findByEmail($email);
        
        if (!$user) {
            // si on  ne récupère pas de model => on a pas d'utilisateur
            // => envoyer une erreur
            $_SESSION['flashMessages'] = ['Utilisateur inexistant'];
            header('Location: ' . $router->generate('user-login'));
        } else {
            // si l'user existe
            // on vérifie que le mot de passe saisi correspond au mot de passe du model 
            $passwordVerified = password_verify($password, $user->getPassword());
            if ($passwordVerified !== false) {
                // si correspondance => on connecte l'user
                // mettre en session les infos utilisateur
                $_SESSION['userId'] = $user->getId();
                $_SESSION['userObject'] = $user;
                header('Location: ' . $router->generate('main-home'));
            } else {
                // sinon on le jette (poliment)
                $_SESSION['flashMessages'] = ['Mot de passe incorrect'];
                header('Location: ' . $router->generate('user-login'));
            }
            
        }
        
    }
    
    // déconnexion
    public function logout()
    {
        global $router; 
        
        // retirer les clés qui concernent l'utilisateur en session
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);
        unset($_SESSION['csrf-token']);
        header('Location: ' . $router->generate('user-login'));
    }

    public function add()
    {
        $this->show('user/add');
    }

    public function addPost()
    {
        global $router;

        // valider les données en POST
        // préparer un array pour stocker les erreurs
        $errors = [];

        // syntaxe condensée :
        // if (! ($email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))) {
        //     // sinon on le jette (poliment)
        //     $_SESSION['flashMessages'] = 'Veuillez entrer un email';
        //     header('Location: ' . $router->generate('user-add'));
        // }
        if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        }else {
            $errors[] = 'Veuillez entrer un email';
        }

        if (filter_input(INPUT_POST, 'firstName')) {
            $firstName = $_POST['firstName'];
        }else {
            $errors[] = 'Veuillez entrer un prénom';
        }

        if (filter_input(INPUT_POST, 'lastName')) {
            $lastName = $_POST['lastName'];
        }else {
            $errors[] = 'Veuillez entrer un nom';
        }

        if (filter_input(INPUT_POST, 'password')) {
            $password = $_POST['password'];
        }else {
            $errors[] = 'Veuillez entrer un mot de passe';
        }

        // vérification de la correspondance du mot de passe saisi et de la confirmation de mot de passe saisie
        if (empty($_POST['password-confirm']) || $password !== $_POST['password-confirm']) {
            $errors[] = 'La confirmation de mot de passe doit correspondre au mot de passe saisi';
        }

        if (filter_input(INPUT_POST, 'role')) {
            $role = $_POST['role'];
        } else {
            $errors[] = 'Veuillez choisir un rôle';
        }

        if (filter_input(INPUT_POST, 'status')) {
            $status = $_POST['status'];
        } else {
            $errors[] = 'Veuillez spécifier un status';
        }

        // vérifier la présence d'erreurs générées au dessus
        if (count($errors) > 0) {
        // si erreurs
            // préparer des flashMessages
            $_SESSION['flashMessages'] = $errors;
            // redirection vers le formulaire
            header('Location: ' . $router->generate('user-add'));
            // arrêt du script
            exit();
        }
        
        // instancier un nouveau model AppUser
        $user = new AppUser();
        // hasher le mot de passe
        $password = password_hash($password, PASSWORD_DEFAULT);
        // l'hydrater => donner des valeurs à ses propriétés
        $user->setEmail($email);
        $user->setFirstname($firstName);
        $user->setLastname($lastName);
        $user->setPassword($password);
        $user->setRole($role);
        $user->setStatus($status);
        // le sauvegarder
        // en testant avec if() directement l'appel à la méthode save(), on teste en fait la valeur de retour de la méthode => save() renvoie soit true (succes) soit false (echec), donc on passera dans le bloc if() si succes, et dans le bloc else si échec
        // la méthode est exécutée au passage
        if ($user->save()) {
            // l'enregistrement s'est bien passé
            // rediriger vers la vue liste
            $redirect = $router->generate('user-list');
        } else {
            // une erreur s'est produite
            // on ajoute un message d'erreur dans les flashMessages, mais même si on a une seule string à afficher, on passe un array
            // => les vues seront adpatées à l'affiche des messages via des arrays seulement
            $_SESSION['flashMessages'] = ["Le nouvel utilisateur {$user->getFirstname()} {$user->getLastname()} n'a pu être ajouté."];
            // rediriger sur le formulaire
            $redirect = $router->generate('user-add');
        }
        
        header('Location: ' . $redirect);
        exit();
    }
    
    public function list()
    {
        
        // récupérer la liste des utilisateurs
        $userList = AppUser::findAll();
        
        // afficher la liste
        $this->show('user/list', [
            'userList' => $userList
        ]);
    }
}
