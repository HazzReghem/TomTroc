<?php

/**
 * Système d'autoload. 
 * A chaque fois que PHP va avoir besoin d'une classe, il va appeler cette fonction 
 * et chercher dnas les divers dossiers (ici models, controllers, views, services) s'il trouve 
 * un fichier avec le bon nom. Si c'est le cas, il l'inclut avec require_once.
 */
// spl_autoload_register(function($className) {
    
//     // On va voir dans le dossier Service si la classe existe.
//     if (file_exists('/../services/' . $className . '.php')) {
//         require_once '/../services/' . $className . '.php';
//     }

//     // On va voir dans le dossier Model si la classe existe.
//     if (file_exists('/../models/' . $className . '.php')) {
//         require_once '/../models/' . $className . '.php';
//     }

//     // On va voir dans le dossier Controller si la classe existe.
//     if (file_exists('/../controllers/' . $className . '.php')) {
//         require_once '/../controllers/' . $className . '.php';
//     }

//     // On va voir dans le dossier View si la classe existe.
//     if (file_exists('/../views/' . $className . '.php')) {
//         require_once '/../views/' . $className . '.php';
//     }

//     // Optionnel : Lancer une exception si la classe n'est pas trouvée
//     throw new Exception("La classe $className est introuvable.");
    
// });

spl_autoload_register(function($className) {
    $baseDir = __DIR__;
    
    $paths = [
        '/../services/' . $className . '.php',
        '/../models/' . $className . '.php',
        '/../controllers/' . $className . '.php',
        '/../views/' . $className . '.php',
    ];

    foreach ($paths as $path) {
        $fullPath = $baseDir . $path;
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;
        } else {
            // echo "Fichier non trouvé : " . $fullPath . "\n";
        }
    }

    throw new Exception("La classe $className est introuvable.");
});