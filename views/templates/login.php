<!-- TEMPLATE DE LA PAGE LOGIN -->

<section id="login-section" arialabelledby="login-title">
    <form action="index.php?action=loginUser" method="post">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        
        <button type="submit" class="submit">Se connecter</button>
    </form>
</section>