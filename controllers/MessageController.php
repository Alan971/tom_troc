<?php
/**
 * Contrôleur de la partie message.
 */
class MessageController {

    /**
     * Envoi vers la messagerie
     * @return void
     */
    public function showMessagePage() :void
    {
        // On vérifie que l'utilisateur est connecté.
        $owner = new AdminController;
        $owner->checkIfUserIsConnected();

        $idUser = $_SESSION['idUser'];
        $idTwitter = Utils::request('idTwitter', "");

        //récupération des échanges
        $messageManager = new MessageManager ;
        $users = $messageManager->getAllUsersTalkingWith($idUser);
        foreach ($users as $user){
            $lastContentnDate [] = $messageManager->getLastMessageById($user->getId(), $idUser);
        }
        // récupération de l'échange en cours s'il existe
        $userTalking = NULL;
        $messages = [];
        if(isset($idTwitter)) {
            if ($idTwitter!="") {
                $messages = $messageManager->getMessagesByUser($idTwitter,$idUser);
                foreach($users as $user) {
                    if ($user->getId() === (int) $idTwitter){
                        $userTalking = $user;
                    }
                }
                $messageManager->setOpenMessageToZero($idTwitter, $idUser);
            }
        }
        $view = new View("Messagerie");
        $view->render("message", ['idUser' => $idUser, 'userTalking' => $userTalking , 'users' => $users , 'messages' => $messages, 'lastContentnDate' => $lastContentnDate]);
    }

    public function addMessage() : void
    {
        // On vérifie que l'utilisateur est connecté.
        $owner = new AdminController;
        $owner->checkIfUserIsConnected();

        $idUser = $_SESSION['idUser'];
        $idTwitter = Utils::request('idTwitter', "");
        $newMessage = Utils::request('newMessage', "");

        $message = new Message();
        $message->setContent($newMessage);
        $message->setidFrom($idUser);
        $message->setidTo($idTwitter);

        $messageManager = new MessageManager ;
        $users = $messageManager->createMessage($message);

        $this->showMessagePage();
    }


}