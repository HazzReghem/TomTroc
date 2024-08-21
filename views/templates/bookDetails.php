<!-- TEMPLATE DE LA PAGE DETAIL DU LIVRE -->

<section id="bookDetails-section" arialabelledby="bookDetails-section-title">

    <p class="filAriane">Nos livres > <?= htmlspecialchars($book['title']) ?></p>

    <div class="bookDetails">
        <img src="<?= htmlspecialchars($book['image']) ?>" alt="Couverture de <?= htmlspecialchars($book['title']) ?>">

        <div class="bookInfo">
            <h1><?= htmlspecialchars($book['title']) ?></h1>
            <p>par <?= htmlspecialchars($book['author']) ?></p>
            <p>Description : <?= htmlspecialchars($book['description']) ?></p>
        </div>
    </div>

</section>
