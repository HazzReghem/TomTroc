<!-- TEMPLATE DE LA PAGE REGISTER -->

<section id="register-section" arialabelledby="register-title">
    <form action="index.php?action=registerUser" method="post">
        <label for="username">Pseudo</label>
        <input type="text" name="username" id="username" required>
        
        <label for="email">Adresse email</label>
        <input type="email" name="email" id="email" required>
        
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
        
        <!-- <label for="confirm_password">Confirmez le mot de passe=</label>
        <input type="password" name="confirm_password" id="confirm_password" required> -->
        
        <button type="submit" class="submit">S'inscrire</button>
    </form>
</section>