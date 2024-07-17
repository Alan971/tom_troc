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
     * @param string $id_user
     * @return ?array
     */
    public function getAllBookByUser(string $id_user) : ?array 
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
     * @param string $id
     * @return ?Book
     */    
    public function getBookById(string $id) : ?Book 
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
     * @param string $order
     * @return ?array
     */
    public function getAllBooks(?string $order, ?string $search) : ?array 
    {
        if (!empty($search)){
            $search = trim($search);
        }
        $params = [];
        // base request
        $sql = <<<EOD
            SELECT b.id, b.id_user, b.title, b.author, b.image, b.comment, b.exchange, u.pseudo 
            FROM books b 
            RIGHT JOIN users u ON b.id_user = u.id
            EOD;
        // add search
        if ($search !== null && !empty($search)) {
            $sql .= " WHERE (b.title LIKE :search OR b.author LIKE :search)";
            $params['search'] = '%' . $search . '%';
        }

        $sql .= " ORDER BY b.id " .$order;

        $result = $this->db->query($sql, $params);
        while ($book = $result->fetch()) {
            if(!empty($book['id'])){
                $bookList[] = new Book($book);
            }
        }
        if(isset($bookList)){
            return $bookList;
        }
        return [];
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
    /**
     * modifie un livre.
     * @param Book $book
     * @return bool
     */
    public function setBookById(Book $book) : ?bool 
    {
        // suppression en bdd
        $sql = "UPDATE books 
                SET title = :title , author = :author, comment = :comment , exchange = :exchange 
                WHERE id = :id";
        $result = $this->db->query($sql, [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'comment' => $book->getComment(),
            'exchange' => $book->getExchange(),
            'id' => $book->getId()
        ]);
        return $result->rowCount() > 0;
    }
    /**
     * ajoute un livre.
     * @param Book $book
     * @return bool
     */
    public function setNewBook(Book $book) : ?bool 
    {
        // suppression en bdd
        $sql = "INSERT INTO books 
                ( title, id_user , author , image, comment  , exchange  )
                VALUES ( :title, :id_user, :author, :img, :comment, :exchange)";
        $result = $this->db->query($sql, [
            'title' => $book->getTitle(),
            'id_user' => $book->getidUser(),
            'author' => $book->getAuthor(),
            'img' => $book->getImage(),
            'comment' => $book->getComment(),
            'exchange' => $book->getExchange()
        ]);
        return $result->rowCount() > 0;
    }

}