<div id="pageMessage">
    <div id="messageList">
        <h2>Messagerie</h2> 
        <?php
        $i=0;
        foreach($users as $user){
        ?>
            <a class="cardMessage" href="index.php?action=Message&idTwitter=<?=$user->getId()?>">
                <img src="<?=$user->getIcon()?>" alt="<?=$user->getPseudo()?>">
                <div class="carDetail">
                    <div class="cardUpperLine">
                        <p class="pseudoMsg"><?=$user->getPseudo()?></p>
                        <p class="dateMsg"><?=$lastContentnDate[$i]['date']?></p>
                    </div>
                    <p class="partMessage"><?=$lastContentnDate[$i]['content']?></p>
                </div>
            </a>
        <?
        $i++;
        }
        ?>
    </div>
    <div id="conversation">
        <div id="showThread">
            
        </div>
        <form id="sendMessageForm" action="index.php?action=addMessage">
            <input type="text" placeholder="tapez votre message ici">
            <button>Envoyer</button>
        </form>
    </div>
</div>