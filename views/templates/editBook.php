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
                $picturePath = "css/assets/" . $book['image'];
                echo '<img src="' . $picturePath . '" alt="Photo de couverture" class="bookPicture">';                
            ?>


        </div>

        <div class="editForm">
            <form action="index.php?action=updateBook" method="post" enctype="multipart/form-data">
            
                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">

                <label for="title">Titre</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>

                <label for="author">Auteur</label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>

                <label for="description">Commentaire</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($book['description']) ?></textarea>

                <label for="description">Auteur</label>
                <input type="text" id="description" name="description" value="<?= htmlspecialchars($book['description']) ?>" required>

                <label for="availability_status">Disponibilité</label>
                <select id="availability_status" name="availability_status" required>
                    <option value="disponible" <?= $book['availability_status'] == 'disponible' ? 'selected' : '' ?>>Disponible</option>
                    <option value="indisponible" <?= $book['availability_status'] == 'indisponible' ? 'selected' : '' ?>>Indisponible</option>
                </select>

                <button type="submit" class="submit">Valider</button>
            </form>
        </div>
    </div>

</section>