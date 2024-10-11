<!-- TEMPLATE DE LA PAGE DETAIL DU LIVRE -->

<section id="bookDetails-section" arialabelledby="bookDetails-section-title">

    <p class="filAriane">Nos livres > <?= htmlspecialchars($book['title']) ?></p>

    <div class="bookDetails">
        <?php 
            $imagePath = "css/assets/" . $book['image'];
            echo '<img src="' . $imagePath . '" alt="' . $book['title'] . '" id="bookCover">';    
        ?>
        <div class="bookInfo">
            <h1><?= htmlspecialchars($book['title']) ?></h1>
            <p class="writtenBy">par <?= htmlspecialchars($book['author']) ?></p>
            <p class="line">______</p>
            <h4>description</h4>
            <p class="description"><?= htmlspecialchars($book['description']) ?></p>
            <h4>Propriétaire</h4>
            <div class="owner">
            <?php
                // Chemin par défaut de la photo de profil
                $defaultPicturePath = "css/user_pic/default.webp"; // Assurez-vous que ce chemin est correct

                // Vérifiez si l'utilisateur a une photo de profil
                if (!empty($book['profile_picture'])) {
                    $picturePath = "css/user_pic/" . $book['profile_picture'];
                } else {
                    $picturePath = $defaultPicturePath; // Utilisez la photo par défaut
                }

                echo '<img src="' . $picturePath . '" alt="Photo de profil" class="profilePicture">';
            ?>
                <p><a href="index.php?action=userBooks&user_id=<?= $book['user_id'] ?>"><?= htmlspecialchars($book['username']); ?></a></p>
            </div>
            <a href="index.php?action=messages&user_id=<?= htmlspecialchars($book['user_id']) ?>" class="submit">Envoyer un message</a>            
        </div>
    </div>

</section>
