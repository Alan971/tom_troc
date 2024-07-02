<?php

class BookController {


public function showhome() :void {

    $bookManager = new BookManager();
    $books = $bookManager->getRecentsBooks();

    $view = new View("Accueil");
    $view->render("home", ['books' => $books]);
}

}