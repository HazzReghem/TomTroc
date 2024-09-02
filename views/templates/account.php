<!-- TEMPLATE DE MON COMPTE -->

<section id="account-section" arialabelledby="account-section-title">
    
    <h1 id="account-section-title">Mon compte</h1>

<!-- Formulaire de mise à jour des informations personnelles -->
<form action="index.php?action=updateUserInfo" method="post">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    
    <button type="submit">Mettre à jour les informations</button>
</form>

<!-- Formulaire de mise à jour de la photo de profil -->
<form action="index.php?action=updateProfilePicture" method="post" enctype="multipart/form-data">
    <label for="profile_picture">Changer de photo de profil:</label>
    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
    
    <button type="submit">Mettre à jour la photo</button>
</form>

<!-- Liste des livres ajoutés par l'utilisateur -->
<h2>Mes livres ajoutés à l'échange</h2>
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