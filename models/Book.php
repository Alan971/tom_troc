<?php

class Book {
    private int $id;
    private int $idUser;
    private string $title = "";
    private string $author = "";
    private string $comment = "";
    private string $pathImage = "";
    private bool $exchange;

    /**
     * Setter pour l'id du livre. 
     * @param int $id
     */
    public function setId(int $id) : void 
    {
        $this->idUser = $id;
    }

    /**
     * Getter pour l'id du livre.
     * @return int
     */
    public function getId() : int 
    {
        return $this->id;
    }

    /**
     * Setter pour l'id de l'utilisateur. 
     * @param int $idUser
     */
    public function setIdUser(int $idUser) : void 
    {
        $this->idUser = $idUser;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getIdUser() : int 
    {
        return $this->idUser;
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
    public function setPathImage(string $pathImage) : void 
    {
        $this->pathImage = $pathImage;
    }

        /**
     * Getter pour l'auteur.
     * @return string
     */
    public function getPathImage() : string 
    {
        return $this->pathImage;
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

}