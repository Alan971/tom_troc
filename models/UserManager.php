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
        $sql = "INSERT INTO users (pseudo, email, password, icon) VALUES (:pseudo , :email , :password , :icon)";
        $result = $this->db->query($sql, [
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'icon' => $user->getIcon()
        ]);
        return $result->rowCount() > 0;
    }
    /**
     * nouvelle instance de User.
     * @param string $email, $pseudo, $icon, $password
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
}

