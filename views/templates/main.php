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
    <link rel="stylesheet" href="./css/stylemain.css">
</head>

<body>
    <header>
        <div class="divHeaderLeft"> 
            <svg width="51" height="51" class="d-block" role="img" focusable="false">
                <title>Tom Troc</title>
                <rect width="51" height="51" cx="0" cy="0" rx="15" ry="15" fill="#00AC66"/>
                <text x="8" y="30" font-family="Playfair Display" font-size="27" fill="white" stroke="white" stroke-width="2">
                    T
                </text>
                <text x="25" y="40" font-family="Playfair Display" font-size="27" fill="white" stroke="white" stroke-width="2">
                    T
                </text>
            </svg>
            <h1>Tom Troc</h1>
            <nav class = "headerLeftNav" aria-roledescription="Navigateur du site">
                <a href="index.php">Accueil</a>
                <a href="index.php?action=apropos">Nos livres à l'échange</a>
            </nav>
        </div>
        <div class="divHeaderRight">
            <nav class="headerRightNav" aria-roledescription="Navigation utilisateur">
                <a href="index.php?action=Message">Messagerie</a>
                <a href="index.php?action=myAccount">Mon compte</a>
                <?php 
                    // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion : 
                    if (isset($_SESSION['user'])) {
                        echo '<a href="index.php?action=disconnectUser">Déconnexion</a>';
                    }
                    else {
                        echo '<a href="index.php?action=connectUser">Connexion</a>';
                    }
                    ?>
            </nav>
        </div>
        
    </header>
    <main>    
        <?= $content /* Ici est affiché le contenu de la page. */ ?>
    </main>
    
    <footer>
        <nav>
            <a href="index.php?action=confPol">Politique de confidentialité</a>
            <a href="index.php?action=legalMentions">Mentions légales</a>
            <a href="index.php?action=home">Tom Troc ©</a>
        </nav>
        <svg width="51" height="51" class="d-block" role="img" focusable="false">
                <title>Tom Troc</title>
                <rect width="51" height="51" cx="0" cy="0" rx="15" ry="15" fill="white"/>
                <text x="8" y="30" font-family="Playfair Display" font-size="27" fill="#00AC66" stroke="#00AC66" stroke-width="2">
                    T
                </text>
                <text x="25" y="40" font-family="Playfair Display" font-size="27" fill="#00AC66" stroke="#00AC66" stroke-width="2">
                    T
                </text>
            </svg>
    </footer>

</body>
</html>