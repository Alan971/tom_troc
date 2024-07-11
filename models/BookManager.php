<?php

class BookManager extends AbstractEntityManager{

    /**
     * Récupère les 4 derniers livres.
     * @param 
     * @return ?array
     */
    public function getRecentsBooks() : ?array 
    {
        $sql = "SELECT b.id, b.id_user, b.title, b.author, b.image, b.comment, b.exchange, u.pseudo 
                FROM books b RIGHT JOIN users u ON b.id_user = u.id ORDER BY b.id DESC LIMIT 4";
        $result = $this->db->query($sql);
        while ($book = $result->fetch()) {
            if(!empty($book['id'])){
                $bookList[] = new Book($book);
            }
        }
        if(isset($bookList)){
            return $bookList;
        }
        return null;
    }

    /**
     * Récupère tous les livres d'un utilisateur.
     * @param $id_user
     * @return ?array
     */
    public function getAllBookByUser($id_user) : ?array 
    {
        $sql = "SELECT * FROM books WHERE id_user = :id";
        $result = $this->db->query($sql, ['id' => $id_user]);
        while ($book = $result->fetch()) {
            if(!empty($book['id'])){
                $bookList[] = new Book($book);
            }
        }
        if(isset($bookList)){
            return $bookList;
        }
        return null;
    }

    /**
     * Récupère un livre par son id.
     * @param $id
     * @return ?Book
     */    
    public function getBookById($id) : ?Book 
    {
        $sql = "SELECT b.id, b.id_user, b.title, b.author, b.image, b.comment, b.exchange, u.pseudo 
                FROM books b RIGHT JOIN users u ON b.id =:id GROUP BY b.id";
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();
        if ($book) {
            return new Book($book);
        }
        return null;
    }

    /**
     * Récupère tous les livres.
     * @param $order
     * @return ?array
     */
    public function getAllBooks(?string $order) : ?array 
    {
        $sql = "SELECT b.id, b.id_user, b.title, b.author, b.image, b.comment, b.exchange, u.pseudo 
                FROM books b RIGHT JOIN users u ON b.id_user = u.id ORDER BY b.id " .$order;
        $result = $this->db->query($sql);
        while ($book = $result->fetch()) {
            if(!empty($book['id'])){
                $bookList[] = new Book($book);
            }
        }
        if(isset($bookList)){
            return $bookList;
        }
        return null;
    }

    /**
     * supprime un livre.
     * @param $id
     * @return bool
     */
    public function supprBook(?string $id) : ?bool 
    {
        // suppression des images
        $book = $this->getBookById($id);
        $pathname = $book->getImage();
        unlink($pathname);
        // suppression en bdd
        $sql = "DELETE FROM books WHERE id =:id";
        $result = $this->db->query($sql, ['id' => $id]);
        return $result->rowCount() > 0;
    }
}