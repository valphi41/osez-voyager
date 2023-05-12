<?php

namespace App\Controller;

use App\Model\TravelMapManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $travelMapManager = new TravelMapManager();
        $countries = $travelMapManager->getAll();

        return $this->twig->render('Home/index.html.twig', ['countries' => $countries]);
    }
    public function notFound(): string
    {
        return $this->twig->render('Home/notfound.html.twig');
    }
}
