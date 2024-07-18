<?php 
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 *      $nbMessage string : nombre de message non lu
 */
$action = Utils::request('action', '');

$nbMessages = "";
if(isset($_SESSION['idUser'])){
    $messageManager = new MessageManager();
    $nbMessages = $messageManager->countNewMessages($_SESSION['idUser']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc</title>
    <link rel="shortcut icon" href="img/tomtroc/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/homestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ga+Maamli&family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="divHeaderLeft"> 
            <svg width="51" height="51" class="d-block" role="img" focusable="false">
                <title>Tom Troc</title>
                <rect width="51" height="51" x="0" y="0" rx="15" ry="15" fill="#00AC66"/>
                <text x="8" y="30" font-family="Playfair Display" font-size="27" fill="white" stroke="white" stroke-width="2">
                    T
                </text>
                <text x="25" y="40" font-family="Playfair Display" font-size="27" fill="white" stroke="white" stroke-width="2">
                    T
                </text>
            </svg>
            <h1>Tom Troc</h1>
            <nav class = "headerLeftNav" aria-roledescription="Navigateur du site">
                <?= $action == ''  ? "<span>Accueil</span>" : "<a href='index.php'>Accueil</a>"; ?>
                <?= $action == 'library' ? "<span>Nos livres à l'échange</span>" : "<a href='index.php?action=library'>Nos livres à l'échange</a>";?>
            </nav>
        </div>
        <div class="divHeaderRight">
            <nav class="headerRightNav" aria-roledescription="Navigation utilisateur">
                <a href="index.php?action=Message"><i class="fa-regular fa-comment"></i>Messagerie</a>
                <p><?=$nbMessages?></p>
                <a href="index.php?action=myAccount"><i class="fa-regular fa-user"></i> Mon compte</a>
                <?php 
                    // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion : 
                    if (isset($_SESSION['user'])) {
                        echo '<a href="index.php?action=disconnectUser">Déconnexion</a>';
                    }
                    else {
                        echo '<a href="index.php?action=connexion">Connexion</a>';
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
                <rect width="51" height="51" x="0" y="0" rx="15" ry="15" fill="white"/>
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