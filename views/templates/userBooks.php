<!-- TEMPLATE DE LA PAGE LIVRES DE L'UTILISATEUR -->

<section id="userBooks-section" arialabelledby="userBooks-section-title">

    <div class="userPicture">    
        <?php
            // Chemin par défaut de la photo de profil
            $defaultPicturePath = "css/user_pic/default.webp"; // Assurez-vous que ce chemin est correct

            // Vérifiez si l'utilisateur a une photo de profil
            if (!empty($user['profile_picture'])) {
                $picturePath = "css/user_pic/" . $user['profile_picture'];
            } else {
                $picturePath = $defaultPicturePath; // Utilisez la photo par défaut
            }

            echo '<img src="' . $picturePath . '" alt="Photo de profil" class="profilePicture">';
        ?>

        <p class="lineTwo">____________________________</p>

        <h2><?= htmlspecialchars($user['username']) ?></h2>
        <p class="dateMember">Membre depuis <?= $timeSinceCreation; ?></p>

        <h4>BIBLIOTHEQUE</h4>
        <div class="userLibrary">
            <img src="css/assets/library.svg" alt="logo de livres" id="libraryIcon">
            <p><?= $bookCount; ?> livre<?= $bookCount > 1 ? 's' : ''; ?></p>
        </div>

        <a href="#" class="submit-bg">Écrire un message</a>
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
