<div id="pageMessage">
    <div id="messageList">
        <h2>Messagerie</h2> 
        <?php
        $i=0;
        if(!isset($users)) :?>
            <p>Pas de message</p>
        <? else : 
        foreach($users as $user){
            if($userTalking!==null) :
                if($user->getId() === $userTalking->getId()) : ?>
                    <a class="cardMessage changeBG" href="index.php?action=Message&idTwitter=<?=$user->getId()?>">
                <? else : ?>
                    <a class="cardMessage" href="index.php?action=Message&idTwitter=<?=$user->getId()?>">
                <? endif; ?>
            <? else : ?>    
                <a class="cardMessage" href="index.php?action=Message&idTwitter=<?=$user->getId()?>">
            <? endif; ?>
                <img src="<?=$user->getIcon()?>" alt="<?=$user->getPseudo()?>">
                <div class="carDetail">
                    <div class="cardUpperLine">
                        <p class="pseudoMsg"><?=$user->getPseudo()?></p>
                        <p class="dateMsg"><?=$lastContentnDate[$i]['date']?></p>
                    </div>
                    <?if($lastContentnDate[$i]['open_message']) : ?>
                        <p class="partMessage unread"><?=$lastContentnDate[$i]['content']?></p>
                    <?else : ?>
                        <p class="partMessage"><?=$lastContentnDate[$i]['content']?></p>
                    <?endif;?>
                </div>
            </a>
        <?
        $i++;
        }
    endif; ?>
    </div>
    <div id="conversation">
        <div id="showThread">
            <?php
            if (isset($messages)) {
                foreach($messages as $message){
                    if($message->getidTo() === $idUser) :?>
                        <div class = "blocDate">
                            <img src="<?= $userTalking->getIcon()?>" alt="Icone">
                            <p class = "leftPositionMessageDate">
                                <?=$message->getDateViewable() ?>
                            </p> 
                        </div>
                        <p class = 'leftPostionMessage'>
                            <?= $message->getContent() ?>
                        </p>
                    <?endif;?>
                    <? if($message->getidFrom() === $idUser) :?>
                        <p class = 'rightPositionMessageDate'>
                            <?=$message->getDateViewable() ?>
                        </p> 
                        <p class = 'rightPostionMessage'>
                            <?= $message->getContent() ?>
                        </p>
                    <?endif;
                }
            }
            ?>
        </div>
        <? if(isset($userTalking)) :?>
        <form id="sendMessageForm" action="index.php?action=addMessage&idTwitter=<?=$userTalking->getId()?>" method="POST">
            <label for="newMessage" hidden>tapez votre message ici</label>
            <input type="text" name="newMessage" id="newMessage" placeholder="tapez votre message ici" autocomplete="off">
            <button>Envoyer</button>
        </form>
        <?endif;?>
    </div>
</div>