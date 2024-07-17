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
        GROUP BY id_From, id_To ORDER BY date ASC";

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
     * @return ?array
     */
    public function getLastMessageById($idTwitter, $id) : ?array
    {
        $sql = "SELECT content, date, open_message FROM message WHERE id_from = :idTwitter AND id_To = :id ORDER BY date DESC LIMIT 1";
       
        $result = $this->db->query($sql, ['idTwitter' => $idTwitter, 'id' => $id]); 
        $lastMessage = $result->fetch();
        if (isset($lastMessage['date'])){
            $lastMessage['date'] = $this->setDateThreadToGoodFormat($lastMessage['date']);
            return $lastMessage;
        }
        // initialisation en cas de creation de nouvelle conversation
        $noMessage['date'] = "";
        $noMessage['content']="";
        $noMessage['open_message']=0;
        return $noMessage;
    }

    /**
     * Récupère tous les messages d'un utilisateur à un autre
     * @param $idFrom, $id
     * @return ?array
     */
    private function getAllMessagesFromAUser($idFrom, $id) :?array
    {
        $sql = "SELECT * FROM message WHERE id_from = :idFrom AND id_to = :id ORDER BY date DESC";
        $result = $this->db->query($sql, ['idFrom' => $idFrom, 'id' => $id]);
        while ($message = $result->fetch()) {
            if(!empty($message['id_from'])) {
                $message['dateViewable'] = $this->setDateMessageToGoodFormat($message['date']);
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
        $sql = "SELECT * FROM message WHERE id_to = :idTo AND id_from = :id ORDER BY date DESC";
        $result = $this->db->query($sql, ['idTo' => $idTo, 'id' => $id]);
        while ($message = $result->fetch()) {
            if(!empty($message['id_to'])) {
                $message['dateViewable'] = $this->setDateMessageToGoodFormat($message['date']);
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
        // contrôle d'existance des message et merge des deux tableaux
        if(is_array($messagesFrom) && is_array($messagesTo)) {
            $mergeMessages = array_merge($messagesFrom, $messagesTo);
        }
        elseif(is_array($messagesFrom) && !is_array($messagesTo)) {
            $mergeMessages = $messagesFrom;
        }
        elseif(!is_array($messagesFrom) && is_array($messagesTo)) {
            $mergeMessages = $messagesTo;
        }
        // tri par date
        if(isset($mergeMessages)){
            usort($mergeMessages, function($a,$b){
                return strtotime($a->getDate())-strtotime($b->getDate());
                }
            );
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
    /**
     * compte le nombre de messages non lus
     * @param  $idTwitter, $id
     * @return void
     */
    public function setOpenMessageToZero ($idTwitter, $id) : void 
    {
        $sql = "UPDATE message SET open_message = 0 WHERE id_from = :idTwitter AND id_to = :id";
        $result = $this->db->query($sql, ['idTwitter' => $idTwitter, 'id' => $id]);
        $result->fetchAll();
    }
    /**
    * ajoute un nouveau message dans la base
    * @param  Message $message
    * @return bool
    */
    public function createMessage(Message $newMessage) : bool 
    {
        $sql = "INSERT INTO message ( id_from, id_to, open_message, content, date ) VALUES (:idFrom, :idTo, '1', :content, NOW() )";
        $result = $this->db->query($sql, [
            'idFrom' => $newMessage->getidFrom() , 
            'idTo' => $newMessage->getidTo(), 
            'content' => $newMessage->getContent()]);
        return $result->rowCount() > 0;

    }
    /**
    * mise en forme de la date des messages
    * @param  string $date
    * @return string
    */
    public function setDateMessageToGoodFormat(string $date) : string 
    {
        // set last year date
        if (date('Y') - date('Y', strtotime($date)) > 0){
            return date('d.m.Y', strtotime($date));
        }
        // set today date
        elseif (date('m') === date('m', strtotime($date)) && date('d') === date('d', strtotime($date))) {
            return date('H:i', strtotime($date));
        }
        // set last day date
        else {
            return date('d.m H:i', strtotime($date));
        }
        
    }
    /**
    * mise en forme de la date des threads
    * @param  string $date
    * @return string
    */
    public function setDateThreadToGoodFormat(string $date) : string 
    {
        // set last year date
        if (date('Y') - date('Y', strtotime($date)) > 0){
            return date('d.m.Y', $date);
        }
        // set today date
        elseif (date('m') === date('m', strtotime($date)) && date('d') === date('d', strtotime($date))) {
            var_dump(date('H:i', strtotime($date)));
            return date('H:i', strtotime($date));
        }
        // set last day date
        else {
            return date('d.m', strtotime($date));
        }
    }
    /**
    * récupération des échanges
    * @param  array $users 
    * @param int $idUser
    * @return array
    */
    public function getThreads(array $users, int $idUser) : array {
        foreach ($users as $user){
            $lastContentnDate [] = $this->getLastMessageById($user->getId(), $idUser);
        }
        return $lastContentnDate;
    }
    /**
    * récupérer l'échange en cours s'il existe ou l'id utilisateur
    * et indiquer message comme lu
    * @param  string $idUser 
    * @param string $idTwitter
    * @return array
    */
    public function getCurrentMessage($idTwitter, $idUser) : array {
        $messages = [];
        if ($idTwitter!="") {
            $messages = $this->getMessagesByUser($idTwitter,$idUser);

            $this->setOpenMessageToZero($idTwitter, $idUser);
        }
        return $messages;

    }
    /**
    * récupérer l'échange en cours s'il existe ou l'id utilisateur
    * et indiquer message comme lu
    * @param string $idTwitter
    * @return User
    */
    public function getCurrentUser($idTwitter) : ?User {
        $userTalking = NULL;
        if ($idTwitter!="") {
            $userTalking = new User();
            $userTalking->setId((int) $idTwitter);
        }
        return $userTalking;
    }
}