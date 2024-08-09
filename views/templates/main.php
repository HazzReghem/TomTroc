<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tom Troc</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=League+Spartan:wght@500;600;700&family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/beda2b5283.js" crossorigin="anonymous"></script>
    </head>
<body>

<header>
    <div class="headerContainer">
        <div class="headerLogo">
            <img src="./css/assets/logo_header.png" alt="">
        </div>

        <div class="navContainer">
            <nav class="mainNav">
                <li>Accueil</li>
                <li>Nos livres à l'échange</li>
            </nav>

            <nav class="userNav">
                <li><i class="fa-regular fa-comment"></i>Messagerie</li>
                <li><i class="fa-regular fa-user"></i>Mon compte</li>
                <li>Connexion</li>
            </nav>
        </div>
    </div>
</header>

<main>
    <?= $content ?>
</main>

<footer>
   <div class="footer">
        <ul>
            <li>Politique de confidentialité</li>
            <li>Mentions légales</li>
            <li>Tom Troc©</li>
            <li><img src="./css/assets/TT_logo.png" alt="Logo abréviation Tom Troc"></li>
        </ul>
   </div>
</footer>
</body>
</html>
