<?php

/** 
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

class UserManager extends AbstractEntityManager 
{
    /**
     * Récupère un user par son email.
     * @param string $email
     * @return ?User
     */
    public function getUserByEmail(string $email) : ?User 
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Récupère un user par son id.
     * @param string $id
     * @return ?User
     */
    public function getUserById(string $id) : ?User 
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * vérifie l'existance d'un pseudo.
     * @param string $pseudo
     * @return bool
     */
    public function getUserByPseudo(string $pseudo) : bool 
    {
        $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
        $result = $this->db->query($sql, ['pseudo' => $pseudo]);
        $user = $result->fetch();
        if ($user) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * crée un nouvel compte utilisateur
     * @param User
     * @return bool
     */
    public function setNewAccount( User $user) :bool
    {
        $sql = "INSERT INTO users (pseudo, email, password, icon, creation_date) VALUES (:pseudo , :email , :password , :icon, NOW())";
        $result = $this->db->query($sql, [
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'icon' => $user->getIcon()
        ]);
        return $result->rowCount() > 0;
    }

    /**
     * modifie le compte utilisateur 
     * @param $id, $email, $pwd, $pseudo
     * @return bool
     */
    public function modifyAccount ($id, $email, $pwd, $pseudo) : bool
    {
        $sql = "UPDATE users SET email = :email, pseudo = :pseudo, password = :password WHERE id = :id";
        $result = $this->db->query($sql, [
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $pwd,
            'id' => $id
        ]); 
        return $result->rowCount() > 0;
    }

    /**
     * nouvelle instance de User.
     * @param string $email, $pseudo, $icon, $password, $creationDate
     * @return ?User
     */
    public function setNewUser($email, $pseudo, $icon, $password) :User
    {
        $user = new User;
        $user->setEmail($email);
        $user->setPseudo($pseudo);
        // $user->setIcon($icon);
        $user->setPassword(password_hash($password,PASSWORD_DEFAULT));
        return $user;
    }
     /**
     * gestion de l'affichage du temps.
     * @param string $dateCreation
     * @return string
     */   
    public function timing ($dateCreation) : string
    {
        $tDate = explode("-", $dateCreation);
        $tNow =  explode("-", date("Y-n-j"));
        if($tNow[0]-$tDate[0]>0){
            $sinceDate = $tNow[0]-$tDate[0];
            $sinceDate = $sinceDate . " an(s)";
        } elseif ($tNow[1]-$tDate[1]>0) {
            $sinceDate = $tNow[1]-$tDate[1];
            $sinceDate = $sinceDate . " mois";
        }elseif($tNow[2]-$tDate[2]>0) {
            $sinceDate = $tNow[2]-$tDate[2];
            $sinceDate = $sinceDate . " jours";
        } else {
            $sinceDate ="peu";
        }

        return $sinceDate;
    }

     /**
     * remplacement de l'icon de l'utilisateur.
     * @param int $idUser
     * @param string $path
     * @return bool
     */  
    public function setIcon($idUser, $path) :bool {
        $sql = "UPDATE users SET icon = :icon WHERE id = :id";
        $result = $this->db->query($sql, [
            'icon' => $path,
            'id' => $idUser
        ]); 
        return $result->rowCount() > 0;
    }

}

