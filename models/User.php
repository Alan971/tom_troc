<?php

/**
 * Entité User : un user est défini par son id, un login et un password.
 */ 
class User extends AbstractEntity 
{
    private string $email="";
    private string $password;
    private string $pseudo="";
    private string $icon="img/icon/defaulticon.png";
    private string $creationDate="";
    /**
     * Setter pour le email.
     * @param string $email
     */
    public function setEmail(string $email) : void 
    {
        $this->email = $email;
    }

    /**
     * Getter pour le email.
     * @return string
     */
    public function getEmail() : string 
    {
        return $this->email;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password) : void 
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword() : string 
    {
        return $this->password;
    }
    /**
     * Setter pour le email.
     * @param string $email
     */
    public function setPseudo(string $pseudo) : void 
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le email.
     * @return string
     */
    public function getPseudo() : string 
    {
        return $this->pseudo;
    }
    /**
     * Setter pour le icon.
     * @param string $icon
     */
    public function setIcon(string $icon) : void 
    {
        $this->icon = $icon;
    }
    /**
     * Getter pour le icon.
     * @return string
     */
    public function getIcon() : string 
    {
        return $this->icon;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $creationDate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setCreationDate(string $creationDate) : void 
    {
        $this->creationDate = $creationDate;
    }

    /**
     * Getter pour la date de création.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime
     */
    public function getCreationDate() : string 
    {
         return $this->creationDate;
    }
    

}