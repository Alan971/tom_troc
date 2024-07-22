<?php
/**
 * Contrôleur de la partie message.
 */
class MessageController {

    /**
     * affichage de la page de messagerie
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
        $lastContentnDate = $messageManager->getThreads($users, $idUser);

        // récupération de l'échange en cours s'il existe
        $messages = $messageManager->getCurrentMessage($idTwitter, $idUser);
        $userTalking = $messageManager->getCurrentUser($idTwitter);

        
        $view = new View("Messagerie");
        $view->render("message", [
            'idUser' => $idUser, 
            'userTalking' => $userTalking , 
            'users' => $users , 
            'messages' => $messages, 
            'lastContentnDate' => $lastContentnDate]);
    }
    /**
     * ajout d'un message 
     * @return void
     */
    public function addMessage() : void
    {
        // On vérifie que l'utilisateur est connecté.
        $owner = new AdminController;
        $owner->checkIfUserIsConnected();

        $idUser = $_SESSION['idUser'];
        $idTwitter = Utils::request('idTwitter', "");
        $newMessage = Utils::format(Utils::request('newMessage', ""));

        $message = new Message();
        $message->setContent($newMessage);
        $message->setidFrom($idUser);
        $message->setidTo($idTwitter);

        $messageManager = new MessageManager ;
        $messageManager->createMessage($message);

        $this->showMessagePage();
    }
    /**
     * affichage de la page de messagerie depuis les autres pages du site
     * single book et account
     * @return void
     */
    public function sendMessageFromSingleBook() : void {
        // On vérifie que l'utilisateur est connecté.
        $owner = new AdminController;
        $owner->checkIfUserIsConnected();

        $idUser = $_SESSION['idUser'];
        $idTwitter = Utils::request('idBookOwner', "");
        
        //récupération des échanges
        $messageManager = new MessageManager ;
        $users = $messageManager->getAllUsersTalkingWith($idUser);
        $lastContentnDate = $messageManager->getThreads($users, $idUser);

        // récupération de l'échange en cours s'il existe
        $messages = $messageManager->getCurrentMessage($idTwitter, $idUser);
        $userTalking = $messageManager->getCurrentUser($idTwitter);

        $view = new View("Messagerie");
        $view->render("message", [
            'idUser' => $idUser, 
            'userTalking' => $userTalking , 
            'users' => $users , 
            'messages' => $messages, 
            'lastContentnDate' => $lastContentnDate]);
    }
}