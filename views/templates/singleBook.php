
<div id = "singleBook">
    <div id = "linkBack">
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
            <div id="owner">
                <img src="img/icon/icontest.png" alt="">
                <span><?=$book->getpseudo()?></span>
            </div>
            <a href="index.php?action=Message?id=<?=$book->getId()?>&id_user=<?=$book->getidUser()?>">Envoyer un message</a>
        </div>
    </div>
</div>
