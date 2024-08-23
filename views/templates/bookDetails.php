<!-- TEMPLATE DE LA PAGE DETAIL DU LIVRE -->

<section id="bookDetails-section" arialabelledby="bookDetails-section-title">

    <p class="filAriane">Nos livres > <?= htmlspecialchars($book['title']) ?></p>

    <div class="bookDetails">
        <img src="<?= htmlspecialchars($book['image']) ?>" alt="Couverture de <?= htmlspecialchars($book['title']) ?>">

        <div class="bookInfo">
            <h1><?= htmlspecialchars($book['title']) ?></h1>
            <p class="writtenBy">par <?= htmlspecialchars($book['author']) ?></p>
            <p class="line">______</p>
            <h4>description</h4>
            <p class="description"><?= htmlspecialchars($book['description']) ?></p>
            <h4>Propriétaire</h4>
            <p class="owner">UTILISATEUR</p>
            <a href="#" class="submit">Envoyer un message</a>
        </div>
    </div>

</section>
