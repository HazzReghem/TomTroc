<!-- TEMPLATE DE MON COMPTE -->

<section id="account-section" aria-labelledby="account-section-title">
    
    <h1 id="account-section-title">Mon compte</h1>

    <div class="userContainer">
        <!-- Formulaire de mise à jour de la photo de profil -->
        <div class="userPicture">    
            <?php
                $defaultPicturePath = "assets/user_pic/default.webp";
                if (!empty($user->getProfilePicture())) {
                    $picturePath = "assets/user_pic/" . $user->getProfilePicture();
                } else {
                    $picturePath = $defaultPicturePath;
                }

                echo '<img src="' . $picturePath . '" alt="Photo de profil" class="profilePicture">';
            ?>
            
            <form action="index.php?action=updateProfilePicture" method="post" enctype="multipart/form-data">
                
                <label for="profile_picture" class="custom-file-upload">modifier</label>
                <input type="file" id="profile_picture" name="profile_picture" onchange="this.form.submit()" accept="image/*">

            </form>

            <p class="lineTwo">_________________________________________</p>

            <h2><?= htmlspecialchars($user->getUsername()) ?></h2>
            <p class="dateMember">Membre depuis <?= $timeSinceCreation; ?></p>

            <h4>BIBLIOTHEQUE</h4>
            <div class="userLibrary">
                <img src="assets/images/library.svg" alt="logo de livres" id="libraryIcon">
                <p><?= $bookCount; ?> livre<?= $bookCount > 1 ? 's' : ''; ?></p>
            </div>
        </div>

        <!-- Formulaire de mise à jour des informations personnelles -->
        <div class="userInfo">
            <form action="index.php?action=updateUserInfo" method="post">

                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="********">
                
                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user->getUsername()) ?>" required>
                
                <button class="submit-bg" type="submit">Enregistrer</button>

            </form>
        </div>
    </div>

    <!-- Liste des livres ajoutés par l'utilisateur -->
    <div>
        <table class="tableBooks">
            <thead>
                <tr>
                    <th class="tableHead">PHOTO</th>
                    <th class="tableHead">TITRE</th>
                    <th class="tableHead">AUTEUR</th>
                    <th class="tableHead">DESCRIPTION</th>
                    <th class="tableHead">DISPONIBILITE</th>
                    <th class="tableHead">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userBooks as $userBook): ?>
                    <tr class="tableCell">
                        <td>
                            <?php 
                                $imagePath = "assets/images/" . $userBook->getImage(); 
                                echo '<img src="' . $imagePath . '" alt="' . $userBook->getTitle() . '">';    
                            ?>
                        </td>
                        <td><?= htmlspecialchars($userBook->getTitle()) ?></td>
                        <td><?= htmlspecialchars($userBook->getAuthor()) ?></td>
                        <td><p><?= htmlspecialchars($userBook->getDescription()) ?></p></td>
                        <td>
                            <?php 
                                $availabilityStatus = $userBook->getAvailabilityStatus();
                                if ($availabilityStatus === 'Disponible') {
                                    echo '<span class="availability-banner-yes">' . htmlspecialchars($availabilityStatus) . '</span>';
                                } else {
                                    echo '<span class="availability-banner-no">' . htmlspecialchars($availabilityStatus ?? 'Statut inconnu') . '</span>';
                                }
                            ?>
                        </td>
                        <td>               
                            <a href="index.php?action=editBook&book_id=<?= $userBook->getId() ?>" class="edit-button">Éditer</a>
                            <a href="index.php?action=deleteBook&book_id=<?= $userBook->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre de votre bibliothèque ?');" class="delete-button">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</section>
