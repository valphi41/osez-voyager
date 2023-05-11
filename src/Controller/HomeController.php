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
        $country = $travelMapManager->getAll();


        return $this->twig->render('Home/index.html.twig', ['country' => $country]);
    }
}
