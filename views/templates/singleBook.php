
<div id = "singleBook">
    <div class = "linkBack">
        <a href="index.php?action=library">Nos livres > <?=$book->getTitle()?></a>
    </div>
    <div id = "singleBookDescription">
        <img src="<?= $book->getImage() != BOOK_IMG_PATH ? $book->getImage() : IMG_BOOK_DEFAULT ?>" alt="Image du livre">
        <div id = "description">
            <div id="titleSingleBook">
                <h2><?=$book->getTitle()?></h2>
                <h3>par <?=$book->getAuthor()?></h3>
                <div id="singleBookLigne"></div>
            </div>
            <div id="singleBookContent">
                <h4>DESCRIPTION</h4>
                <p><?=$book->getComment()?></p>
            </div>
            <div id="singleBookProprietaire">
                <h4>PROPRIETAIRE</h4>
                <? if($idUser === $book->getidUser()) :?>
                    <a id="owner" href="#">
                        <img src="<?=$owner->getIcon()?>" alt="Icone">
                        <p><?=$owner->getPseudo()?></p>
                    </a>
                <? else :?>
                    <a id="owner" href="index.php?action=account&idUser=<?=$book->getidUser()?>">
                        <img src="<?=$owner->getIcon()?>" alt="Icone">
                        <span><?=$owner->getPseudo()?></span>
                    </a>
                    <a id="sendMessage" href="index.php?action=MessageFromSBorAcc&idBookOwner=<?=$book->getidUser()?>">
                        Envoyer un message
                    </a>
                <? endif; ?>
            </div>
</div>
    </div>
</div>
