<?php 
/**
 * Contrôleur de la partie admin.
 */
 
class AdminController {

    private string $errorTxt = "";

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    public function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            $this->displayConnectionForm();
            exit;
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
        $email = Utils::format(Utils::request("email"));
        $password = Utils::format(Utils::request("password"));

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
        $pseudo = Utils::format(Utils::request("pseudo"));
        $email = Utils::format(Utils::request("email"));
        $password = Utils::format(Utils::request("password"));
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
        $user = $userManager->getUserByEmail($email);
        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page de compte.
        $this->showMyAccount();

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
    /**
     * dirige vers la page de compte utilisateur.
     * @return void
     */
    public function showMyAccount() :void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();    
        $idUser = $_SESSION['idUser'];
        if (empty($this->errorTxt)) {
            $inputIcon = Utils::request("InputIcon", "");
        }
        else {
            $inputIcon = "1";
        }
        $user = new UserManager;
        $me = $user->getUserById($idUser);
        $time = $user->timing($me->getcreationDate());   
        $books = new BookManager;
        $mybooks = [];
        if(is_array($books->getAllBookByUser(($me->getId())))) 
        {
            $mybooks = $books->getAllBookByUser(($me->getId()));
        }

        // On affiche la page du compte.
        $view = new View("account");
        $view->render("account", [
            'me' => $me, 
            'mybooks' => $mybooks, 
            'time' =>  $time, 
            'InputIcon' => $inputIcon,
            'errorTxt' => $this->errorTxt
        ]);
    }
    /**
     * dirige vers la page de compte d'un utilisateur.
     * @return void
     */
    public function showAccount() :void
    {           
        $idUser= Utils::request("idUser");

        $user = new UserManager;
        $me = $user->getUserById($idUser);
        $time = $user->timing($me->getcreationDate());     
        $books = new BookManager;
        $mybooks = [];
        if(is_array($books->getAllBookByUser(($me->getId())))) 
        {
            $mybooks = $books->getAllBookByUser(($me->getId()));
        }
        // On affiche la page du compte.
        $view = new View("account");
        $view->render("account", [
            'me' => $me, 
            'mybooks' => $mybooks, 
            'time' =>  $time, 
            'errorTxt' => $this->errorTxt,
            'InputIcon' => ""
        ]);
    }

    /**
     * gère la modification de compte avant de renvoyer vers la page de compte de l'utilisateur.
     * @return void
     */
    public function modifyAccount() :void 
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        $idUser = $_SESSION['idUser'];
        $pseudo = Utils::format(Utils::request("pseudo"));
        $email = Utils::format(Utils::request("email"));
        $password = Utils::format(Utils::request("password"));
        
        //contrôle des éléments à modifier
        $isvalid = "Il faut renseigner tous les champs";
        if(isset($email) && isset($password) && isset($pseudo)){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $isvalid = "L'adresse mail n'est pas correcte";
            }
            else {
                $isvalid="ok";
            }
        }
        // enregistrement dans la base
        if($isvalid === "ok"){
            $modifyUser = new UserManager;
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $result = $modifyUser->modifyAccount($idUser, $email, $hashedPassword, $pseudo);
            if(!$result) {
                throw new Exception("L'enregistrement n'a pas été effectué");
            }
            $isvalid = "Enregistrement effectué";
        }

        $user = new UserManager;
        $me = $user->getUserById($idUser);
        $time = $user->timing($me->getcreationDate());   
        $books = new BookManager;
        $mybooks = [];
        if(is_array($books->getAllBookByUser(($me->getId())))) 
        {
            $mybooks = $books->getAllBookByUser(($me->getId()));
        }

        // On affiche la page du compte.
        $view = new View("account");
        $view->render("account", [
            'me' => $me, 
            'mybooks' => $mybooks, 
            'time' =>  $time, 
            'isvalid' => $isvalid,  
            'errorTxt' => $this->errorTxt,
            'InputIcon' => ""
        ]);
    }
   
    /**
     * modification de l'icon de l'utilisateur.
     * @return void
     */
    public function askForUserIcon() : void {

        $idUser= $_SESSION['idUser'];

       //téléchargement sur le serveur
        $uploadIcon = new UploadImg();
        $this->errorTxt = $uploadIcon->setUserIcon("imageUpload", ICON_USER_PATH, $idUser);
        $this->showMyAccount();
    }
}