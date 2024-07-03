<?php

class BookController {


public function showhome() :void {

    $bookManager = new BookManager();
    $books = $bookManager->getRecentsBooks();


    $view = new View("Accueil");
    $view->render("home", ['books' => $books]);
}

public function showLibrary() :void {

    $bookManager = new BookManager();
    $books = $bookManager->getAllBooks("");


    $view = new View("Nos livres");
    $view->render("library", ['books' => $books]);
}

public function showSingleBook() :void {
    // Récupération de l'id du livre demandé.
    $id = Utils::request("id", -1);
    $bookManager = new BookManager();
    $book = $bookManager->getBookById($id);

    $view = new View($book->getTitle());
    $view->render("singleBook", ['book' => $book]);
}
}