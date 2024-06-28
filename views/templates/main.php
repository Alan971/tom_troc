<?php 
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav class = "siteNav">
            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="155" height="51" class="d-block" viewBox="0 0 612 612" role="img" focusable="false">
                    <title>Tom Troc</title>
                    <rect width="51" height="51" fill="#00AC66">
                    <text x="25" y="5" font-family="Playfair Display" font-size="27" fill="white" stroke="black" stroke-width="2">
                        T
                    </text>
                    <text x="35" y="25" font-family="Playfair Display" font-size="27" fill="white" stroke="black" stroke-width="2">
                        T
                    </text>
                </svg>
            </div>
            <a href="index.php">Accueil</a>
            <a href="index.php?action=apropos">À propos</a>
            <?php 
                // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion : 
                if (isset($_SESSION['user'])) {
                    echo '<a href="index.php?action=disconnectUser">Déconnexion</a>';
                }
                ?>
        </nav>
        <h1>Emilie Forteroche</h1>
    </header>

    <main>    
        <?= $content /* Ici est affiché le contenu de la page. */ ?>
    </main>
    
    <footer>
        <p>Copyright ©  - Openclassrooms - <a href="index.php?action=admin">Admin</a>
    </footer>

</body>
</html>