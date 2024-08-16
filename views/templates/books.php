<!-- TEMPLATE DE LA PAGE DE LIVRES DISPONIBLES -->
 

<section id="availableBooks-section" arialabelledby="availableBooks-section-title">
    
    <div class="topContainer">
        <h1 id="availableBooks-section-title">Nos livres disponibles à l'échange</h1>

        <form method="GET" action="index.php?action=books">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" size="15" placeholder="Rechercher un livre..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        </form>
    </div>

    <?php if (!empty($books)): ?>

        <div class="availableBooks">
            <?php foreach ($books as $book): ?>
            
                <article class="bookCard BookCard-library">
                    <img src="<?= htmlspecialchars($book['image']) ?>" alt="Couverture de <?= htmlspecialchars($book['title']) ?>">

                    <h3><?= htmlspecialchars($book['title']) ?></h3>
                    <p><?= htmlspecialchars($book['author']) ?></p>

                    <p class="soldBy">Vendu par : UTILISATEUR</p>
                </article>

            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <p>Aucun livre disponible à l'échange pour le moment.</p>
    <?php endif; ?>
</section>
