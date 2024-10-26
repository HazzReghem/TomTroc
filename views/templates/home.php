<!-- TEMPLATE DE LA PAGE DACCUEIL -->

<section id="discover-section" aria-labelledby="join-us-section">
    <div class="discoverContainer">
        <h1 id="join-us-section">Rejoignez nos lecteurs passionnés</h2>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
        <a href="index.php?action=books" class="submit">Découvrir</a>
    </div>
    <div class="discoverIllustation">
        <img src="./assets/images/library.webp" alt="photo d'un homme avec des centaines de libres">
        <p>Hamza</p>
    </div>
</section>

<section id="books-section" aria-labbeledby="books-section-title">
    
    <h2 id="books-section-title">Les derniers livres ajoutés</h2>

    <div class="lastBooks">
        <?php foreach ($lastBooks as $book): ?>

            <a href="index.php?action=bookDetails&id=<?= htmlspecialchars($book->getId()) ?>">

                <article class="bookCard">
                    
                    <?php 
                        $imagePath = "assets/images/" . $book->getImage();
                        echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($book->getTitle()) . '">';    
                    ?>
                    
                    <h3><?= htmlspecialchars($book->getTitle()) ?></h3>
                    <p><?= htmlspecialchars($book->getAuthor()) ?></p>

                    <p class="soldBy">Vendu par : <?= htmlspecialchars($book->getUsername()) ?></p>
                
                </article>
            </a>

        <?php endforeach; ?>
    </div>


    <a href="index.php?action=books" class="submit">Voir tous les livres</a>
</section>

<section id="how-to-section" arialabelledby="how-to-section-title">

    <h2 id="how-to-section-title">Comment ça marche ?</h2>
    <p class="sub-title">Échanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commencer :</p>

    <div class="stepContainer">
        <p class="step">Inscrivez-vous gratuitement sur notre plateforme.</p>
        <p class="step">Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        <p class="step">Parcourez les livres disponibles chez d'autres membres.</p>
        <p class="step">Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
    </div>
    
    <a href="index.php?action=books" class="submit-bg">Voir tous les livres</a>
</section>

<section id="values-section" arialabelledby="values-section-title">
    
    <div class="banner">
        <img src="./assets/images/banner.png" alt="bannière montrant une femme de dos regardant une pile de livre">
    </div>
    
    <div class="about-us">
        <h2 id="values-section-title">Nos valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.<br />
        <br />

        Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. <br />
        <br />

        Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p><br />
        
        <p class="team">L'équipe Tom Troc</p>
        
    </div>

    <img src="./assets/images/Vector_2.svg" alt="signature en forme de coeur" class="signature">
</section>

