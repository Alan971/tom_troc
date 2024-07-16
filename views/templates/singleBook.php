
<div id = "singleBook">
    <div class = "linkBack">
        <a href="index.php?action=library">Nos livres > <?=$book->getTitle()?></a>
    </div>
    <div id = "singleBookDescription">
        <img src="<?=$book->getImage()?>" alt="<?=$book->getTitle?>">
        <div id = "description">
            <h2><?=$book->getTitle()?></h2>
            <span id = "detail1">par <?=$book->getAuthor()?></span>
            <p>______</p>
            <br>
            <p>DESCRIPTION</p>
            <br>
            <span><?=$book->getComment()?></span>
            <br><br><br>
            <p>PROPRIETAIRE</p>
            <? if($owner->getId() ===$book->getidUser()) :?>
                <a id="owner" href="#">
            <? else :?>
                <a id="owner" href="index.php?action=account&idUser=<?=$book->getidUser()?>">
            <? endif; ?>
                <img src="<?=$owner->getIcon()?>" alt="">
                <span><?=$owner->getPseudo()?></span>
            </a>
            <a id="sendMessage" href="index.php?action=MessageFromSingleBook&idBook=<?=$book->getId()?>&idBookOwner=<?=$book->getidUser()?>">Envoyer un message</a>
        </div>
    </div>
</div>
