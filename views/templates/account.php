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
    <div>
        <table class="tableBooks">
            <thead>
                <tr>
                    <th class="tableHead">
                        PHOTO
                    </th>
                    <th class="tableHead">
                        TITRE
                    </th>
                    <th class="tableHead">
                        AUTEUR
                    </th>
                    <th class="tableHead">
                        DESCRIPTION
                    </th>
                    <th class="tableHead">
                        DISPONIBILITE
                    </th>
                    <th class="tableHead">
                        ACTION
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userBooks as $userBook) { ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($userBook['image']) ?>" alt="Couverture de <?= htmlspecialchars($userBook['title']) ?>"></td>
                        <td><?= htmlspecialchars($userBook['title']) ?></td>
                        <td><?= htmlspecialchars($userBook['author']) ?></td>
                        <td><?= htmlspecialchars($userBook['description']) ?></td>
                        <td><?= htmlspecialchars($userBook['availability_status']) ?></td>
                        <td><?= htmlspecialchars($userBook['author']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</section>