<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'home':
            $bookController = new BookController();
            $bookController->showHome();
            break;
        case 'library':
            $bookController = new BookController();
            $bookController->showLibrary();
            break;
        case 'singleBook':
            $bookController = new BookController();
            $bookController->showSingleBook();
            break;
        // user access      
        case 'inscription':
            $adminController = new AdminController();
            $adminController->displayInscriptionForm();
            break;
        case 'connexion':
            $adminController = new AdminController();
            $adminController->displayConnectionForm();
            break;
        case 'connectUser':
            $adminController = new AdminController();
            $adminController->connectUser();
            break;
        case 'disconnectUser':
            $adminController = new AdminController();
            $adminController->disconnectUser();
            break; 
        case 'newUser' :
            $adminController = new AdminController();
            $adminController->createUser();
            break;
        case 'myAccount' :
            $adminController = new AdminController();
            $adminController->showMyAccount();
            break;
        case 'account' :
            $adminController = new AdminController();
            $adminController->showAccount();
            break;
        case 'modifyAccount' :
            $adminController = new AdminController();
            $adminController->modifyAccount();        
            break;
        case 'Message' :
            
            break;

        case 'addBook':

            break;
        case 'edition':

            break;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}