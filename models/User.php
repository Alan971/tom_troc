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
     * Setter pour le email.
     * @param string $email
     */
    public function setIcon(string $icon) : void 
    {
        $this->icon = $icon;
    }

    /**
     * Getter pour le email.
     * @return string
     */
    public function getIcon() : string 
    {
        return $this->icon;
    }



}