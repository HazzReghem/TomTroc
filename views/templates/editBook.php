<!-- TEMPLATE DE LA PAGE EDITION DU LIVRE -->

<section id="editBook-section" arialabelledby="editBook-section-title">

    <div class="editHeader">
        <a class="filAriane" href="index.php?action=account"><i class="fa-solid fa-arrow-left"></i>retour</a>
        <h2 id="editBook-section-title">Modifier les informations</h2>
    </div>

    <div class="editContainer">

        <div class="bookPicture">

            <p>Photo</p>
            <?php
                $picturePath = "assets/images/" . $book->getImage();
                echo '<img src="' . $picturePath . '" alt="Photo de couverture" class="bookPicture">';                
            ?>

            <form action="index.php?action=updateBookImage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="book_id" value="<?= htmlspecialchars($book->getId()) ?>">
                <label for="book_picture" class="custom-file-upload">Modifier la photo</label>
                <input type="file" id="book_picture" name="book_picture" onchange="this.form.submit()" accept="image/*">
            </form>

        </div>

        <div class="editForm">
            <form action="index.php?action=updateBookDetails" method="post" enctype="multipart/form-data">
                <input type="hidden" name="book_id" value="<?= htmlspecialchars($book->getId()) ?>">

                <label for="title">Titre</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($book->getTitle()) ?>" required>

                <label for="author">Auteur</label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($book->getAuthor()) ?>" required>

                <label for="description">Commentaire</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($book->getDescription()) ?></textarea>

                <label for="availability_status">Disponibilité</label>
                <select id="availability_status" name="availability_status" required>
                    <option value="disponible" <?= $book->getAvailabilityStatus() == 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                    <option value="Pas disponible" <?= $book->getAvailabilityStatus() == 'Pas disponible' ? 'selected' : '' ?>>Pas disponible</option>
                </select>

                <button type="submit" class="submit">Valider</button>
            </form>
        </div>
    </div>

</section>
