<?php


class MessageManager extends AbstractEntityManager
{
    
    /**
     * récupère toutes les utilisateurs avec qui l'utilisateur a une conversation. 
     * @param $idUser
     * @return array
     */
    public function getAllUsersTalkingWith($idUser) :?array
    {
        $sql = "SELECT id_From, id_To FROM message WHERE id_From =:id OR id_To = :id 
        GROUP BY id_From, id_To ORDER BY date DESC";
        $result = $this->db->query($sql, ['id' => $idUser]);
        while ($idUsers = $result->fetch()) {
            if(!empty($idUsers['id_From'])) {
                $listId [] = $idUsers['id_From'];
                $listId [] = $idUsers['id_To'];
            }
        }
        $listId = array_unique($listId);
        $manager = new UserManager();
        foreach($listId as $idTalkingUser) 
        {
            if($idTalkingUser != $idUser) {
                $users [] = $manager->getUserById($idTalkingUser);
            }
        }
        return $users;
    }
    /**
     * récupère le dernier message envoyé par celui avec qui l'utilisateur a une conversation. 
     * @param $idTwitter, $id
     * @return array
     */
    public function getLastMessageById($idTwitter, $id) :array
    {
        $sql = "SELECT content, date, open_message FROM message WHERE id_from = :idTwitter AND id_To = :id ORDER BY date DESC LIMIT 1";
        $result = $this->db->query($sql, ['idTwitter' => $idTwitter, 'id' => $id]); 
        return $result->fetch();
    }

    /**
     * Récupère tous les messages d'un utilisateur à un autre
     * @param $idFrom, $id
     * @return ?array
     */
    private function getAllMessagesFromAUser($idFrom, $id) :?array
    {
        $sql = "SELECT * FROM message WHERE id_From = :idFrom AND id_To = :id ORDER BY date DESC";
        $result = $this->db->query($sql, ['idFrom' => $idFrom, 'id' => $id]);
        while ($message = $result->fetch()) {
            if(!empty($message['id_From'])) {
                $messages [] = new Message($message);
            }
        }
        if(isset($messages)) {
            return $messages;
        }
        return null;
    }
    /**
     * Récupère tous les messages d'un utilisateur à un autre
     * @param $idTo, $id
     * @return ?array
     */
    private function getAllMessagesToAUser($idTo, $id) :?array
    {
        $sql = "SELECT * FROM message WHERE id_To = :idTo AND id_From = :id ORDER BY date DESC";
        $result = $this->db->query($sql, ['idTo' => $idTo, 'id' => $id]);
        while ($message = $result->fetch()) {
            if(!empty($message['id_From'])) {
                $messages [] = new Message($message);
            }
        }
        if(isset($messages)) {
            return $messages;
        }
        return null;
    }
    /**
     * merge 2 tableaux de message
     * @param ?array $messagesFrom, ?array $messagesTo
     * @return ?array
     */
    private function mergeTableMessageAndOrder(?array $messagesFrom, ?array $messagesTo) : ?array
    {

        $mergeMessages = $messagesFrom + $messagesTo;
        if(is_array($mergeMessages)) {
            $columns = array_column($mergeMessages, 'date');
            array_multisort($columns, SORT_DESC, $mergeMessages);
        }
        else {
            return null;
        }
        return $mergeMessages;
    }
    /**
     * Récupère tous les messages d'un utilisateur à un autre
     * @param $idFrom, $id
     * @return ?array
     */
    public function getMessagesByUser($idTwitter, $myId) :?array
    {
            return $this->mergeTableMessageAndOrder($this->getAllMessagesFromAUser($idTwitter, $myId) , $this->getAllMessagesToAUser($idTwitter, $myId));
    }

    /**
     * compte le nombre de messages non lus
     * @param  $id
     * @return string
     */
    public function countNewMessages($id) : string {
        if(isset($id)){
            $sql = "SELECT SUM(open_message) AS nb FROM message WHERE id_To = :id";
            $result = $this->db->query($sql, ['id' => $id]);
            $tab = $result->fetch();
            if($tab['nb'] === "0") { 
                return "";
            }
            return $tab['nb'];
        }
        return "";
    }

}