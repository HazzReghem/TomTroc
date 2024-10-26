<!-- TEMPLATE DE LA PAGE LIVRES DE L'UTILISATEUR -->

<section id="userBooks-section" arialabelledby="userBooks-section-title">

    <div class="userPicture">    
        <?php
            // Chemin par défaut de la photo de profil
            $defaultPicturePath = "css/user_pic/default.webp"; // Assurez-vous que ce chemin est correct

            // Vérifiez si l'utilisateur a une photo de profil
            if (!empty($user->getProfilePicture())) {
                $picturePath = "css/user_pic/" . $user->getProfilePicture();
            } else {
                $picturePath = $defaultPicturePath; // Utilisez la photo par défaut
            }

            echo '<img src="' . $picturePath . '" alt="Photo de profil" class="profilePicture">';
        ?>

        <p class="lineTwo">____________________________</p>

        <h2><?= htmlspecialchars($user->getUsername()) ?></h2>
        <p class="dateMember">Membre depuis <?= $timeSinceCreation; ?></p>

        <h4>BIBLIOTHEQUE</h4>
        <div class="userLibrary">
            <img src="css/assets/library.svg" alt="logo de livres" id="libraryIcon">
            <p><?= $bookCount; ?> livre<?= $bookCount > 1 ? 's' : ''; ?></p>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="index.php?action=messages&user_id=<?= htmlspecialchars($user->getId()) ?>" class="submit">Écrire un message</a>
            <?php else: ?>    
            <a href="index.php?action=login" class="submit">Écrire un message</a>  
        <?php endif; ?>
    </div>

    <div class="booksList">
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userBooks as $userBook) { ?>
                    <tr class="tableCell">
                        <td>
                        <?php 
                            $imagePath = "css/assets/" . $userBook['image'];
                            echo '<img src="' . $imagePath . '" alt="' . $userBook['title'] . '">';    
                        ?>
                        </td>
                        <td><?= htmlspecialchars($userBook['title']) ?></td>
                        <td><?= htmlspecialchars($userBook['author']) ?></td>
                        <td><p><?= htmlspecialchars($userBook['description']) ?></p></td>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
