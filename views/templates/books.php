<section id="availableBooks-section" arialabelledby="availableBooks-section-title">
    <div class="topContainer">
        <h1 id="availableBooks-section-title">Nos livres à l'échange</h1>
        <form method="GET" action="index.php?action=books">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="hidden" name="action" value="searchBooks">
            <input type="text" name="search" size="15" placeholder="Rechercher un livre..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <datalist id="book-titles">
                <?php foreach ($titles as $title): ?>
                    <option value="<?= htmlspecialchars($title) ?>">
                <?php endforeach; ?>
            </datalist>
        </form>
    </div>

    <?php if (!empty($books)): ?>
        <div class="availableBooks">
            <?php foreach ($books as $book): ?>
                
                <a href="index.php?action=bookDetails&id=<?= htmlspecialchars($book->getId()) ?>">
                    <article class="bookCard BookCard-library">
                        <?php 
                            $imagePath = "assets/images/" . ($book->getImage() ?? 'default.jpg');
                            echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($book->getTitle() ?? 'Livre sans titre') . '">';    
                        ?>
                        <h3><?= htmlspecialchars($book->getTitle() ?? 'Titre inconnu') ?></h3>
                        <p><?= htmlspecialchars($book->getAuthor() ?? 'Auteur inconnu') ?></p>
                        <?php 
                        // var_dump($book->getUsername())
                        ?>
                        <p class="soldBy">Vendu par : <?= htmlspecialchars($book->getUsername() ?? 'Inconnu'); ?></p>
                        <?php if ($book->getAvailabilityStatus() !== 'Disponible'): ?>
                            <span class="not-available-banner">non dispo.</span>
                        <?php endif; ?>
                    </article>
                </a>    
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun livre ne correspond à votre recherche.</p>
    <?php endif; ?>
</section>
