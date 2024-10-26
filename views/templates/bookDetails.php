<!-- TEMPLATE DE LA PAGE DETAIL DU LIVRE -->

<section id="bookDetails-section" aria-labelledby="bookDetails-section-title">

    <p class="filAriane">Nos livres > <?= htmlspecialchars($book->getTitle()) ?></p>

    <div class="bookDetails">
        <?php 
            $imagePath = "assets/images/" . $book->getImage();
            echo '<img src="' . $imagePath . '" alt="' . $book->getTitle() . '" id="bookCover">';    
        ?>
        <div class="bookInfo">
            <h1><?= htmlspecialchars($book->getTitle()) ?></h1>
            <p class="writtenBy">par <?= htmlspecialchars($book->getAuthor()) ?></p>
            <p class="line">______</p>
            <h4>description</h4>
            <p class="description"><?= htmlspecialchars($book->getDescription()) ?></p>
            <h4>Propriétaire</h4>
            <div class="owner">
            <?php
                $defaultPicturePath = "assets/user_pic/default.webp";

                if (!empty($book->getProfilePicture())) {
                    $picturePath = "assets/user_pic/" . $book->getProfilePicture();
                } else {
                    $picturePath = $defaultPicturePath; 
                }

                echo '<img src="' . $picturePath . '" alt="Photo de profil" class="profilePicture">';
            ?>
                <p><a href="index.php?action=userBooks&user_id=<?= $book->getUserId() ?>"><?= htmlspecialchars($book->getUsername()); ?></a></p>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="index.php?action=messages&user_id=<?= htmlspecialchars($book->getUserId()) ?>" class="submit">Envoyer un message</a>
            <?php else: ?>    
                <a href="index.php?action=login" class="submit">Envoyer un message</a>  
            <?php endif; ?>
        </div>
    </div>

</section>
