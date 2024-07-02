<div id="homePartOne">
    <div id="introductionText">
        <h2>Rejoignez nos lecteurs passionnés</h2>
        <p>
            Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture.
            Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.
        </p>
        <a href="index.php?action=decouvrir">Découvrir</a>
    </div>
    <div id="imageAccueil">
        <img src="img/tomtroc/hamza-nouasria-KXrvPthkmYQ-unsplash 1.png" alt="">
        <p class="author">Hamza</p>
    </div>
</div>
<div id="lastBooks">
    <h2>Les derniers livres ajoutés</h2>
    <div class="Cards">
        <?php
        foreach($books as $book){
             echo " 
             <div class='Card'>
                <img src=" . $book->getImage() . " alt=". $book->getTitle() .">
                <h3>". $book->getTitle() ."</h3>
                <h4>". $book->getAuthor() ."</h4>
                <p class='author'>Vendu par : ". $book->getTitle() ."</p>
             </div>";

        }
            
        ?>
    </div>
    <a href="index.php?action=library">Voir tous les livres</a>
</div>
<div id="homePartThree">
    <h2>Comment ça marche ?</h2>
    <span>
        Echanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commencer :
    </span>
    <ul>
        <li>Inscrivez-vous gratuitement sur notre plateforme.</li>
        <li>Ajoutez les livres que vous souhaitez échanger à votre profil.</li>
        <li>Parcourez les livres disponibles chez d'autres membres.</li>
        <li>Proposez un échange et discutez avec d'autres pasionnés de lecture.</li>
    </ul>
    <a href="index.php?action=library.php">Voir tous les livres</a>
    <img src="img/tomtroc/Mask group.png" alt="">
    <h2>Nos Valeurs</h2>
    <div id="valeurEtSigle">
        <p id="valeurs">
            Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. 
            Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. 
            Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes. 
            <br><br>
            Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. 
            <br><br>
            Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, 
            de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
        </p>
        <img id="sigleCoeur" src="img/tomtroc/Vector 2.svg" alt="">
        <p class="author">
            L’équipe Tom Troc
        </p>
    </div>
</div>





