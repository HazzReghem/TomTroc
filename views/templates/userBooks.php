<!-- TEMPLATE DE LA PAGE LIVRES DE L'UTILISATEUR -->

<section id="userBooks-section" arialabelledby="userBooks-section-title">

    <div class="userPicture">    
        <?php
            $defaultPicturePath = "assets/user_pic/default.webp"; 

            // Affichez la photo de profil de l'utilisateur
            if (!empty($user->getProfilePicture())) {
                $picturePath = "assets/user_pic/" . $user->getProfilePicture();
            } else {
                $picturePath = $defaultPicturePath;
            }

            echo '<img src="' . $picturePath . '" alt="Photo de profil" class="profilePicture">';
        ?>

        <p class="lineTwo">____________________________</p>

        <h2><?= htmlspecialchars($user->getUsername()) ?></h2>
        <p class="dateMember">Membre depuis <?= $timeSinceCreation; ?></p>

        <h4>BIBLIOTHEQUE</h4>
        <div class="userLibrary">
            <img src="assets/images/library.svg" alt="logo de livres" id="libraryIcon">
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
                    <th class="tableHead">PHOTO</th>
                    <th class="tableHead">TITRE</th>
                    <th class="tableHead">AUTEUR</th>
                    <th class="tableHead">DESCRIPTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userBooks as $userBook): ?>
                    <tr class="tableCell">
                        <td>
                        <?php 
                            // Affichez la photo du livre
                            $imagePath = "assets/images/" . $userBook->getImage();
                            echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($userBook->getTitle()) . '">';    
                        ?>
                        </td>
                        <td><?= htmlspecialchars($userBook->getTitle()) ?></td>
                        <td><?= htmlspecialchars($userBook->getAuthor()) ?></td>
                        <td><p><?= htmlspecialchars($userBook->getDescription()) ?></p></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
