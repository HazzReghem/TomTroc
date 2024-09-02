<!-- TEMPLATE DE MON COMPTE -->

<section id="account-section" arialabelledby="account-section-title">
    
    <h1 id="account-section-title">Mon compte</h1>


    <div class="userContainer">
        <!-- Formulaire de mise à jour de la photo de profil -->
        <div class="userPicture">       
            <img src="<?= htmlspecialchars($user['profile_picture']) ?>" alt="Photo de profil">

            <form action="index.php?action=updateProfilePicture" method="post" enctype="multipart/form-data">
                
                <label for="profile_picture">modifier</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                
                <button type="submit">Mettre à jour la photo</button>

            </form>
        </div>

        <!-- Formulaire de mise à jour des informations personnelles -->
        <div class="userInfo">
            <form action="index.php?action=updateUserInfo" method="post">

                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

                 
                
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="********">
                
                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                
                <button class="submit-bg" type="submit">Enregistrer</button>

            </form>
        </div>
    </div>

    <!-- Liste des livres ajoutés par l'utilisateur -->
    <?php if (!empty($userBooks)): ?>
        <ul>
            <?php foreach ($userBooks as $book): ?>
                <li><?= htmlspecialchars($book['title']) ?> - <?= htmlspecialchars($book['author']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Vous n'avez pas encore ajouté de livres à l'échange.</p>
    <?php endif; ?>

</section>