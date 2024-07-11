<?php

class BookController {

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

        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks("");

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
        
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        $view = new View($book->getTitle());
        $view->render("singleBook", ['book' => $book]);
    }

    /**
     * suppression d'un livre
     * @param 
     * @return void
     */
    public function removeBook() :void 
    {
        // Récupération de l'id du livre demandé.
        $id = Utils::request("id", -1);
        $bookManager = new BookManager();
        $book = $bookManager->supprBook($id);

        // On redirige vers la page de compte.
        Utils::redirect("myAccount");
    }
}