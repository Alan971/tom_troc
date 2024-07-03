<div id="linkBack">
    <a href="index.php?action=library">Nos livres > <?=$book->getTitle()?></a>
</div>
<div id="singleBook">
<img src="<?=$book->getImage()?>" alt="<?=$book->getTitle?>">
<h2><?=$book->getTitle()?></h2>
<p>par <?=$book->getAuthor()?></p>
<p>______</p>
<p>DESCRIPTION</p>
<p><?=$book->getComment()?></p>
<p>PROPRIETAIRE</p>
<div>
    <img src="" alt="">
    <?=$book->getpseudo()?>
</div>
<a href="index.php?action=Message?id="<?=$book->getId()?>>Envoyer un message</a>

</div>