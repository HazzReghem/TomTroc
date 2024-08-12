<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tom Troc</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=League+Spartan:wght@500;600;700&family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/beda2b5283.js" crossorigin="anonymous"></script>
    </head>
<body>

<header>
    <div class="headerContainer">
        <div class="headerLogo">
            <a href="#"><img src="./css/assets/logo_header.png" alt=""></a>
        </div>

        <div class="navContainer">
            <nav class="mainNav">
                <a href="#"><li>Accueil</li></a>
                <a href="#"><li>Nos livres à l'échange</li></a>
            </nav>

            <nav class="userNav">
            <a href="#"><li><i class="fa-regular fa-comment"></i>Messagerie</li></a>
            <a href="#"><li><i class="fa-regular fa-user"></i>Mon compte</li></a>
            <a href="#"><li>Connexion</li></a>
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
