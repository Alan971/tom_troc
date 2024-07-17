<?php

class BookController {

    private string $errorTxt="";
    /**
     * Accès à la page d'accueil
     * @param 
     * @return void
     */
    public function showhome() :void {

        $bookManager = new BookManager();
        $books = $bookManager->getRecentsBooks();

        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }

    /**
     * Accès aux livres
     * @param 
     * @return void
     */
    public function showLibrary() :void {

        $search = Utils::request("search", null);
        
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks("", $search);

        $view = new View("Nos livres");
        $view->render("library", ['books' => $books]);
    }

    /**
     * Accès à un livre
     * @param 
     * @return void
     */
    public function showSingleBook() :void {
        // Récupération de l'id du livre demandé.
        $id = Utils::request("id", -1);
        $idUser = $_SESSION['idUser'];

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        //récupération des informations du propriétaire
        $bookOwner = new UserManager;
        $owner = $bookOwner->getUserById($book->getidUser());

        $view = new View($book->getTitle());
        $view->render("singleBook", ['book' => $book, 'owner' => $owner, 'idUser' => $idUser]);
    }

    /**
     * suppression d'un livre
     * @param 
     * @return void
     */
    public function removeBook() :void 
    {
        // On vérifie que l'utilisateur est connecté.
        $owner = new AdminController;
        $owner->checkIfUserIsConnected();
        // Récupération de l'id du livre demandé.
        $id = Utils::request("id", -1);
        $idUser = $_SESSION['idUser'];

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        // contrôle de l'appartenance du livre à l'auteur
        if($book->getidUser() != $idUser) {
            throw new Exception("Vous n'êtes pas autorisé a accéder à ce livre");
        }

        $book = $bookManager->supprBook($id);

        // On redirige vers la page de compte.
        Utils::redirect("myAccount");
    }

    /**
     * lien vers la page de modification d'un livre
     * @param 
     * @return void
     */
    public function showModifyBook() :void
    {
        // On vérifie que l'utilisateur est connecté.
        $owner = new AdminController;
        $owner->checkIfUserIsConnected();
        if (empty($this->errorTxt)) {
            $inputIcon = Utils::request("InputIcon", "");
        }
        else {
            $inputIcon = "1";
        }
        // Récupération de l'id du livre demandé.
        $id = Utils::request("id", -1);
        $idUser = $_SESSION['idUser'];
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        // contrôle de l'appartenance du livre à l'auteur
        if($book->getidUser() != $idUser) {
            throw new Exception("Vous n'êtes pas autorisé a accéder à ce livre");
        }
        $view = new View($book->getTitle());
        $view->render("modifybook", [
        'book' => $book, 
        'InputIcon' => $inputIcon,
        'errorTxt' => $this->errorTxt
    ]);
    }

    /**
     * effectue la modification du livre et renvoie vers la page myAccount
     * @param 
     * @return void
     */
    public function doModifyBook() :void
    {
        // Récupération des modif du livre demandé.
        $id = Utils::request("id", -1);
        $title = Utils::request("titleBook");
        $author = Utils::request("author");
        $comment = Utils::request("comment");
        $exchange = Utils::request("exchange");

        $modifiedBook = new Book();
        $modifiedBook->setId($id);
        $modifiedBook->setTitle($title);
        $modifiedBook->setAuthor($author);
        $modifiedBook->setComment($comment);
        $modifiedBook->setExchange($exchange);

        $bookManager = new BookManager();
        $result = $bookManager->setBookById($modifiedBook);
        if($result) {
            Utils::redirect("myAccount");
        }
        else {
            $bookManager = new BookManager();
            $book = $bookManager->getBookById($id);
            
            $view = new View($book->getTitle());
            $view->render("modifybook", ['book' => $book, 'error' => "Enregistrement non réalisé"]);
        }
    }
    /**
     * lien vers la page d'ajout de livre
     * @param 
     * @return void
     */
    public function showAddBook() :void
    {
        // On vérifie que l'utilisateur est connecté.
        $owner = new AdminController;
        $owner->checkIfUserIsConnected();

        $book = new Book();

        $view = new View("Nouveau livre");
        $view->render("modifybook", [
            'book' => $book
        ]);
    }
    /**
     * ajout de livre
     * @param 
     * @return void
     */
    public function doAddBook() :void
    {
        // Récupération des ajouts du livre demandé.
        $idUser = $_SESSION['idUser'];
        $title = Utils::request("titleBook");
        $author = Utils::request("author");
        $comment = Utils::request("comment");
        $exchange = Utils::request("exchange");
        $image = Utils::request("image", "img/imagepardefaut.png");

        $newBook = new Book();
        $newBook->setidUser($idUser);
        $newBook->setTitle($title);
        $newBook->setAuthor($author);
        $newBook->setComment($comment);
        $newBook->setExchange($exchange);
        $newBook->setImage($image);

        $bookManager = new BookManager();
        $result = $bookManager->setNewBook($newBook);
        if($result) {
            Utils::redirect("myAccount");
        }
        else { 
            throw new Exception("Une erreur est survenue : l'enregistrement n'a par été réalisé");
        }
    }

    /**
     * modification de l'image du livre.
     * @return void
     */
    public function askforBookImage() : void {

        $idUser= $_SESSION['idUser'];
        $idBook = Utils::request("id", -1);

       //téléchargement sur le serveur
        $uploadIcon = new UploadImg();
        $this->errorTxt = $uploadIcon->setBookImage("imageUpload", "img/", $idBook);

        $this->showModifyBook();
    }
}