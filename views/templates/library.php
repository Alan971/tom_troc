<div id="library">
    <div id="titleSearchLibrary">
        <h2>Nos livres à l'échange</h2>
        <form action="">
            <label for="search" name="search"></label>
            <input type="text" name="search" id="search" placeholder="Rechercher un livre">
        </form>
    </div>
    <div class="Cards">
        <?php
        foreach($books as $book){
             echo " 
             <a class='Card' href='index.php?action=singleBook&id=". $book->getId() . "'>
                <img src=" . $book->getImage() . " alt=". $book->getTitle() .">
                <h3>". $book->getTitle() ."</h3>
                <h4>". $book->getAuthor() ."</h4>
                <p class='author'>Vendu par : ". $book->getPseudo() ."</p>
             </a>";
        }  
        ?>
    </div>

</div>

<?php
