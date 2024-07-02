<?php

class BookController {


public function showhome() :void {

    $bookManager = new BookManager();
    $books = $bookManager->getRecentsBooks();
// var_dump($books);
    $view = new View("Accueil");
    $view->render("home", ['books' => $books]);
}

}