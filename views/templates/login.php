<!-- TEMPLATE DE LA PAGE LOGIN -->

<section id="login-section" arialabelledby="login-title">
    <div class="login register">

        <h1 id="login-title">Connexion</h1>

        <form action="index.php?action=loginUser" method="post">
            <label for="email">Adresse mail</label>
            <input type="text" name="email" id="email" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit" class="submit">Se connecter</button>
        </form>

        <p>Pas de compte ? <a href="index.php?action=register">Inscrivez-vous</a></p>

    </div>

    <img src="./assets/images/books.png" alt="Photo de plusieurs livres">
</section>