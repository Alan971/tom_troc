<?php



class Message extends AbstractEntity
{
    private int $idFrom;
    private int $idTo;
    private bool $openMessage;
    private string $content = "";
    private string $date;

    /**
     * Setter pour l'id de l'utilisateur emeteur du message. 
     * @param int $idFrom
     */
    public function setidFrom(int $idFrom) : void 
    {
        $this->idFrom = $idFrom;
    }
    /**
     * Getter pour l'id de l'utilisateur emeteur du message.
     * @return int
     */
    public function getidFrom() : int 
    {
        return $this->idFrom;
    }

    /**
     * Setter pour l'id de l'utilisateur destinataire du message.
     * @param int $idTo
     */
    public function setidTo(int $idTo) : void 
    {
        $this->idTo = $idTo;
    }
    /**
     * Getter pour l'id de l'utilisateur destinataire du message.
     * @return int
     */
    public function getidTo() : int 
    {
        return $this->idTo;
    }
/**
     * Setter pour l'id de l'utilisateur emeteur du message. 
     * @param int $openMessage
     */
    public function setOpenMessage(int $openMessage) : void 
    {
        $this->openMessage = $openMessage;
    }
    /**
     * Getter pour l'id de l'utilisateur emeteur du message.
     * @return int
     */
    public function getOpenMessage() : int 
    {
        return $this->openMessage;
    }

    /**
     * Setter pour l'id de l'utilisateur emeteur du message. 
     * @param string $content
     */
    public function setContent(string $content) : void 
    {
        $this->content = $content;
    }
    /**
     * Getter pour l'id de l'utilisateur emeteur du message.
     * @return string
     */
    public function getContent() : string 
    {
        return $this->content;
    }
    /**
     * Setter pour l'id de l'utilisateur emeteur du message. 
     * @param string $date
     */
    public function setDate(string $date) : void 
    {
        $this->date = $date;
    }
    /**
     * Getter pour l'id de l'utilisateur emeteur du message.
     * @return string
     */
    public function getDate() : string 
    {
        return $this->date;
    }

}