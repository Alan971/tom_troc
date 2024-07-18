<div id="pageModifyBook">
    <div id = "linkBacknTitle">
        <a href="index.php?action=myAccount">← Retour</a>
        <?if($book->getId()===-1) :?>
            <h2>Ajouter un livre</h2>
        <?else :?>
            <h2>Modifier les informations</h2>
        <?endif;?>
    </div>
    <div id = "singleBookRecap">
        <div id="modifyPageLeft">
            <p>Photo</p>
            <?if($book->getImage()==="") :?>
                <img src="img/tomtroc/defaut.png" alt="image par défaut">
            <?else :?>
                <img src="<?=$book->getImage()?>" alt="<?=$book->getImage()?>">
            <?endif;?>
            <? if($InputIcon ==="1") :?>
                <form  id="selectFile" method="POST" action="index.php?action=uploadBookImage&id=&id=<?=$book->getId()?>" enctype="multipart/form-data" >
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                    <label for="imageUpload" title="Cherchez le fichier à uploader"><?=$errorTxt?></label>
                    <input id = "imageUpload" type = "file" name = "imageUpload" />
                    <input id = "registerButton" name = "submit" type = "submit" value = "Enregistrer" />
                </form>
            <?elseif ($book->getId()!=-1) : ?>
                <a id="modifyIcon" href="index.php?action=modifyBookImage&id=<?=$book->getId()?>&InputIcon=1">Modifier la photo</a>
            <? endif;?>
        </div>
        <?if($book->getId()===-1) :?>
            <form id = "modifyPageRight" action="index.php?action=doAddBook" method="POST">
        <?else :?>
            <form id = "modifyPageRight" action="index.php?action=doModifyBook&id=<?=$book->getId()?>" method="POST">
        <?endif;?>
            <label for="titleBook">Titre</label>
            <input type="text" id="titleBook" name="titleBook" value="<?=$book->getTitle()?>" required>
            <label for="author">Auteur</label>
            <input type="text" id="author" name="author" value="<?=$book->getAuthor()?>" required>
            <label for="inputComment">Commentaire</label>
            <textarea id="inputComment" name="comment"><?=$book->getComment()?></textarea>             
            <label for="exchange">Disponibilité</label>
            <select name="exchange" id="exchange">
                <option value="0">non dispo.</option>
                <option value="1" selected>disponible</option>
            </select>
            <button id="modifyBookButton" type="submit">Valider</button>
            <?if(isset($error)) :?>
                <p><?="* " . $error?></p>
            <?endif;?>
        </form>
    </div>
</div>