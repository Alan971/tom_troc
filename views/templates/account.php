<? if ($me->getId()===$_SESSION['idUser']) : ?>
<div id="myAccount">
    <div id="title">
        <h2>Mon compte</h2>
    </div>
<?else : ?>
    <div id="account">
<?endif;?>  
    <? if ($me->getId()===$_SESSION['idUser']) : ?>
    <div id="placingPersonnalInfo">
        <!-- account detail -->
        <div id="accountDetail">
    <?else : ?>
        <div id="ownerDetail">
    <?endif;?>
            <img src="<?=$me->getIcon()?>" alt="">
            <? if ($me->getId()===$_SESSION['idUser']) : ?>
                <? if($InputIcon === "") : ?>
                    <a id="modifyIcon" href="index.php?action=modifyUserIcon&InputIcon=1">Modifier</a>
                <?elseif($InputIcon ==="1") :?>
                    <form  id="selectFile" method="POST" action="index.php?action=uploadIcon" enctype="multipart/form-data" >
                        <label for="imageUpload" title="Cherchez le fichier à uploader"><?=$errorTxt?></label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                        <input id = "imageUpload" type = "file" name = "imageUpload" />
                        <input id = "registerButton" name = "submit" type = "submit" value = "Enregistrer" />
                    </form>
                <? endif;?>
            <?endif;?>
            <p id="pseudoName"><?=$me->getPseudo()?></p>
            <p >Membre depuis <?=$time?></p>
            <p id="titleLibrary">BIBLIOTHEQUE</p>
            <div id="nbBooks">
                <svg width="25" height="19" role="img" focusable="false">        
                    <rect width="6" height="17" x="1" y="1" rx="1" ry="1" style="stroke:black;fill:none;"/>
                    <polygon points = "10 17, 16 18, 18 2, 12 1" />
                </svg>
                <?php
                    $i=0;
                    foreach($mybooks as $book){ 
                        $i++;
                    }
                ?>
                 <?=$i?> livres
            </div>
            <?if($me->getId()!=$_SESSION['idUser']) : ?>
                <a class="linkGreenBorder messagingButton" href="index.php?action=MessageFromSBorAcc&idBookOwner=<?=$me->getId()?>">
                    Ecrire un message
                </a>
            <?else :?>
                <a class="linkGreenBorder messagingButton" href="index.php?action=addBook">
                    Ajouter un livre
                </a>
            <?endif; ?>
        </div>
        <!-- personnal info -->
        <? if ($me->getId()===$_SESSION['idUser']) : ?>
            <div id="personnalInfo">
                <form action="index.php?action=modifyAccount" method="POST">
                    <h3>Vos informations personnelles</h3>
                    <div class = "inscriptionForm">
                        <label for="email">Adresse email</label>
                        <input type="email" name="email" id = "email" value="<?=$me->getEmail()?>" required>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id ="password" value="" required>
                        <label for="pseudo">Pseudo</label>
                        <input type="text" value="<?=$me->getPseudo()?>" name="pseudo" id = "pseudo" required>
                        <button class="linkGreenBorder">Enregistrer</button>
                        <?if(isset($isvalid)) : ?>
                            <p id="infoSave"><?=$isvalid?></p>
                        <?endif;?>
                    </div>
                </form>
            </div>
    </div>
    <?endif;?>
    <!-- library table -->
    <? if ($me->getId()===$_SESSION['idUser']) : ?>
        <div id="table">
            <div id="thead" class="tableRow">
    <?else : ?>
        <div id="tableOwner">
            <div id="thead" class="tableRowsimplyfy">
    <?endif;?>
                <p>PHOTO</p>
                <p>TITRE</p>
                <p>AUTEUR</p>
                <p>DESCRIPTION</p>
            <? if ($me->getId()===$_SESSION['idUser']) : ?>
                <p>DISPONIBILITE</p>
                <p>ACTION</p>
            <?endif;?>
            </div>
            <div id="tbody">
            <?php
                $i=0;
                foreach($mybooks as $book){ 
            ?>
                <? if ($me->getId()===$_SESSION['idUser']) : ?>
                <div class = "tableRow flag<?=($i%2)?>">
                    <img src="<?=$book->getImage()?>" alt="<?=$book->getTitle()?>">
                    <p>
                        <?=$book->getTitle()?>
                    </p>
                    <p>
                        <?=$book->getAuthor()?>
                    </p>
                    <div class="tableComment">
                        <?=$book->getComment()?>
                </div>
                <?else :?>
                    <?if ($book->getExchange()) :?>
                        <div class = "tableRowsimplyfy flag<?=($i%2)?>">
                            <img src="<?=$book->getImage()?>" alt="<?=$book->getTitle()?>">
                            <p>
                                <?=$book->getTitle()?>
                            </p>
                            <p>
                                <?=$book->getAuthor()?>
                            </p>
                            <div class="tableComment">
                                <?=$book->getComment()?>
                        </div>
                    <?endif;?>
                <?endif;?>
                <?if ($me->getId()===$_SESSION['idUser']) : ?>
                    <?if ($book->getExchange()) : ?> 
                        <span class = 'superGreen dispo'>disponible</span>
                    <?else : ?>
                        <span class = 'red dispo'>non dispo.</span>
                    <?endif;?>
                    <p>
                        <a id="modifyBook" href="index.php?action=modifyBook&id=<?=$book->getId()?>">Editer</a>
                        <a id="supprBook" href="index.php?action=supprBook&id=<?=$book->getId()?>">Supprimer</a>
                    </p>
                <?endif;?>
                </div>
            <?  
                $i++;
                } 
            ?>
            </div>
        </div>
</div>