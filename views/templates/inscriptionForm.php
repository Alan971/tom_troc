<div class="inscription">
    <div class="leftPanel">
        <h2>Inscription</h2>
        <form action="index.php?action=newUser" method="POST">
            <div class = "inscriptionForm">
                <label for="pseudo">Pseudo</label>
                <input type="text" value="" name="pseudo" id = "pseudo" required>
                <label for="email">Adresse email</label>
                <input type="email" name="email" id = "email" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id ="password" required>
                <button class="linkGreen">S'inscrire</button>
            </div>
        </form>
        <div class="changeChoice"><p>Déjà inscrit ?</p><a href="index.php?action=connexion">Connectez-vous</a></div>
        
    </div>
    <img src="img/tomtroc/Mask group1.png">
</div>