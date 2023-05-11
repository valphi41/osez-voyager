<?php

namespace App\Controller;

use App\Model\SurvivantManager;

class SurvivantController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $survivantManager = new SurvivantManager();
        $survivants = $survivantManager->selectAll('name');
        return $this->twig->render('Survivants/index.html.twig', ['survivants' => $survivants]);
    }
}
