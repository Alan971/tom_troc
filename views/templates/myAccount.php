
<div id="myAccount">

    <div id="title">
        <h2>Mon compte</h2>
    </div>
    <div id="placingPersonnalInfo">
        <!-- account detail -->
        <div id="accountDetail">
            <img src="<?=$me->getIcon()?>" alt="">
            <a href="">modifier</a>
            <p id="pseudoName"><?=$me->getPseudo()?></p>
            <p >Membre depuis <?/*=$me->getYear()*/?></p>
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
        </div>
        <!-- personnal info -->
        <div id="personnalInfo">
            <form action="index.php?action=myAccount" method="POST">
                <h3>Vos informations personnelles</h3>
                <div class = "inscriptionForm">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id = "email" value="<?=$me->getEmail()?>" required>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id ="password" value="" required>
                    <label for="pseudo">Pseudo</label>
                    <input type="text" value="<?=$me->getPseudo()?>" name="pseudo" id = "pseudo" required>
                    <button class="linkGreenBorder">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
    <!-- library table -->
    <div id="myLibrary">
        <table>
            <thead>
                <tr>
                    <th>PHOTO</th>
                    <th>TITRE</th>
                    <th>AUTEUR</th>
                    <th>DESCRIPTION</th>
                    <th>DISPONIBILITE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i=0;
                foreach($mybooks as $book){ 
            ?>
                    <tr class = "flag<?=($i%2)?>">
                        <td>
                            <img src="<?=$book->getImage()?>" alt="<?=$book->getTitle()?>">
                        </td>
                        <td>
                            <?=$book->getTitle()?>
                        </td>
                        <td>
                            <?=$book->getAuthor()?>
                        </td>
                        <td>
                            <?=$book->getComment()?>
                        </td>
                        <td>
                            <?=$book->getExchange() ? "<p class = 'superGreen dispo'>disponible</p>" : "<p class = 'red dispo'>non dispo.</p>"?>
                        </td>
                        <td>
                            <a id="modifyBook" href="index.php?action=modifyBook?id=<?=$book->getId()?>">Editer</a>
                            <a id="supprBook" href="index.php?action=supprBook?id=<?=$book->getId()?>">Supprimer</a>
                        </td>
                    </tr>
            <?  
                $i++;
                } 
            ?>
            </tbody>
        </table>
    </div>
</div>