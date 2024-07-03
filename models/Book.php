<?php
/**
 * Entité Book, un livre est défini par les champs
 * id, id_user, title, comment, image, exchange
 */
class Book extends AbstractEntity {

    private int $id_user;
    private string $title = "";
    private string $author = "";
    private string $comment = "";
    private string $image = "";
    private bool $exchange;
    private string $pseudo = "";


    /**
     * Setter pour l'id de l'utilisateur. 
     * @param int $id_user
     */
    public function setid_user(int $id_user) : void 
    {
        $this->id_user = $id_user;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getid_user() : int 
    {
        return $this->id_user;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitle(string $title) : void 
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle() : string 
    {
        return $this->title;
    }

    /**
     * Setter pour le commentaire.
     * @param string $comment
     */
    public function setComment(string $comment) : void 
    {
        $this->comment = $comment;
    }

        /**
     * Getter pour le commentaire.
     * @return string
     */
    public function getComment() : string 
    {
        return $this->comment;
    }

    /**
     * Setter pour l'auteur.
     * @param string $comment
     */
    public function setAuthor(string $author) : void 
    {
        $this->author = $author;
    }

        /**
     * Getter pour l'auteur.
     * @return string
     */
    public function getAuthor() : string 
    {
        return $this->author;
    }
    
    /**
     * Setter pour l'auteur.
     * @param string $comment
     */
    public function setImage(string $image) : void 
    {
        $this->image = $image;
    }

        /**
     * Getter pour l'auteur.
     * @return string
     */
    public function getImage() : string 
    {
        return $this->image;
    }
    /**
     * Setter pour l'echange du livre. 
     * @param int $exchange
     */
    public function setExchange(int $exchange) : void 
    {
        $this->exchange = $exchange;
    }

    /**
     * Getter pour l'echange'.
     * @return int
     */
    public function getExchange() : int 
    {
        return $this->exchange;
    }

    /**
     * Getter pour le pseudo du vendeur'.
     * @return string
     */
    public function getPseudo() :string
    {
        return $this->pseudo;
    }
    /**
     * Setter pour le pseudo du vendeur. 
     * @param string
     */
    public function setPseudo(string $pseudo) : void 
    {
        $this->pseudo = $pseudo;
    }


}