<!-- TEMPLATE DE LA PAGE EDITION DU LIVRE -->

<section id="editBook-section" arialabelledby="editBook-section-title">

    <h2 id="editBook-section-title">Modifier les informations</h2>

    <form action="index.php?action=updateBook" method="post" enctype="multipart/form-data">
        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">

        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>

        <label for="author">Auteur :</label>
        <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($book['description']) ?></textarea>

        <label for="availability_status">Statut de disponibilité :</label>
        <select id="availability_status" name="availability_status" required>
            <option value="disponible" <?= $book['availability_status'] == 'disponible' ? 'selected' : '' ?>>Disponible</option>
            <option value="indisponible" <?= $book['availability_status'] == 'indisponible' ? 'selected' : '' ?>>Indisponible</option>
        </select>

        <label for="photo">Modifier la photo :</label>
        <input type="file" id="photo" name="photo">

        <input type="hidden" name="existing_photo" value="<?= htmlspecialchars($book['photo']) ?>">

        <button type="submit">Mettre à jour</button>
    </form>

</section>