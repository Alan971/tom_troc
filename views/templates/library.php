<div id="library">
    <div id="titleSearchLibrary">
        <h2>Nos livres à l'échange</h2>
        <form action="index.php?action=library" method="POST">
            <label for="search" name="search"></label>
            <div id = "searchBar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="search" id="search" placeholder=" Rechercher un livre">
            </div>
            <input type="submit" hidden>
        </form>
    </div>
    <div class="Cards">
        <?php
        foreach($books as $book){?>
            <?if($book->getExchange()) :?>
                <a class='Card' href='index.php?action=singleBook&id=<?=$book->getId()?>"'>
                    <img src="<?=$book->getImage()?>" alt="<?$book->getTitle()?>">
                    <h3><?=$book->getTitle()?></h3>
                    <h4><?=$book->getAuthor()?></h4>
                    <p class='author'>Vendu par : <?=$book->getPseudo()?></p>
                </a>
            <?endif;
        }  
        ?>
    </div>

</div>

<?php
