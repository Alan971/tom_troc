<?php 
/**
 * Contrôleur de la partie admin.
 */
 
class AdminController {

    /**
     * Affiche la page d'administration.
     * @return void
     */
    public function showAdmin() : void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        // On récupère les livres.
        $bookManager = new BookManager();
        $books = $bookManager->getAllBookByUser($_SESSION['user']);

        // On affiche la page d'administration.
        $view = new View("Administration");
        $view->render("admin", [
            'articles' => $books
        ]);
    }

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function displayConnectionForm() : void 
    {
        $view = new View("Connexion");
        $view->render("connexionForm");
    }

    /**
     * Affichage du formulaire de d'inscription.
     * @return void
     */
    public function displayInscriptionForm() : void 
    {
        $view = new View("Inscription");
        $view->render("inscriptionForm");
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connectUser() : void 
    {
        // On récupère les données du formulaire.
        $email = Utils::request("email");
        $password = Utils::request("password");
        // On vérifie que les données sont valides.
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            var_dump($password);
            var_dump($user->getPassword());
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect.");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page de compte.
        Utils::redirect("myAccount");
    }
    /**
     * inscription d'un utilisateur.
     * @return void
     */
    public function createUser() : void 
    {
        // On récupère les données du formulaire.
        $pseudo = Utils::request("pseudo");
        $email = Utils::request("email");
        $password = Utils::request("password");
        // On vérifie que les données sont valides.
        if (empty($email) || empty($password) || empty($pseudo)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if ($user) {
            throw new Exception("Vous avez déjà un compte");
            // a modifier : rediriger vers la page de connexion
        }
        // on vérifie que le pseudo n'est pas déjà utilisé
        $isExist = $userManager->getUserByPseudo($pseudo);
        if($isExist) {
            throw new Exception("Ce pseudo existe déjà");
            // a modifier : rediriger vers la page d'inscription
        }

        // on enregistre le nouvel utilisateur
        $icon="";
        $user= $userManager->setNewUser($email, $pseudo, $icon, $password);

        if (!$userManager->setNewAccount($user))
        {
            throw new Exception("Le compte n'a pas été créé.");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page de compte.
        Utils::redirect("myAccount");

    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser() : void 
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }

    public function showMyAccount() :void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();
        
        $idUser= $_SESSION['idUser'];
        $user = new UserManager;
        $me = $user->getUserById($idUser);
        $books = new BookManager;
        $mybooks = [];
        if(is_array($books->getAllBookByUser(($me->getId())))) 
        {
            $mybooks = $books->getAllBookByUser(($me->getId()));
        }

        // On affiche la page du compte.
        $view = new View("myAccount");
        $view->render("myAccount", [
            'me' => $me, 'mybooks' => $mybooks
        ]);

    }
   
}