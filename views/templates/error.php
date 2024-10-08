<section id="error-section" arialabelledby="error-section-title">
    <div class="error-container">
        <h1 id="error-section-title">Erreur <?= $errorCode ?? '404' ?></h1>
        <p><?= $errorMessage ?? "Oups ! La page que vous cherchez n'existe pas." ?></p>
        <a class="submit" href="index.php?action=home">Retour à l'accueil</a>
    </div>
</section>