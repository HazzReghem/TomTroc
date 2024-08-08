<?php

require_once __DIR__ . '/../views/View.php';

class MainController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $view = new View("Accueil");
        $view->render("home", ['message' => 'Bienvenue sur la page d\'accueil !']);
    }
}