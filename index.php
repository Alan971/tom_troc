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
            
            break;
        case 'library':

            break;
        case 'singleBook':

            break;
        case 'inscription':

            break;
        case 'connecion':

            break;
        case 'profil':

            break;
        case 'publicProfil':

            break;
        case 'edition':

            break;
        case 'message':
            
            break;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}