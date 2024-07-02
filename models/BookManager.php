<?php


class BookManager extends AbstractEntityManager{


public function getRecentsBooks() : ?array {
    
    $result = $this->getAllBooks("DESC");
    if(isset($result)){
        for($i=0; $i<4; $i++){
            if(isset($result[$i]))
            $bookList[] = $result[$i];
        }
        return $bookList;
    }
    return null;
}

public function getAllBookByUser($id_user) : array {
    $sql = "SELECT * FROM books WHERE id_user = :id";
    $result = $this->db->query($sql, ['id' => $id_user]);
    while ($book = $result->fetch()) {
        $bookList[] = new Book($book);
    }
    return $bookList;
}

public function getBookById($id) : ?Book {

    $sql = "SELECT * FROM books WHERE id = :id";
    $result = $this->db->query($sql, ['id' => $id]);
    $book = $result->fetch();
    if ($book) {
        return new book($book);
    }
    return null;
}

public function getAllBooks(?string $order) : ?array {

    $sql = "SELECT * FROM books AS b ORDER BY b.id " .$order;
    $result = $this->db->query($sql);
    $bookList = Null;
    while ($book = $result->fetch()) {
        $bookList[] = new Book($book);
    }
    return $bookList;
}

}