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

        $messageManager = new MessageManager ;
        $users = $messageManager->getAllUsersTalkingWith($idUser);
        foreach ($users as $user){
            $lastContentnDate [] = $messageManager->getLastMessageById($user->getId(), $idUser);
        }

        $messages = [];
        if(isset($idTwitter)) {
            $messages = $messageManager->getMessagesByUser($idTwitter,$idUser);
        }

        $view = new View("Messagerie");
        $view->render("message", ['users' => $users , 'messages' => $messages, 'lastContentnDate' => $lastContentnDate]);
    }
}