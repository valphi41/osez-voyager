<?php

namespace App\Controller;

class SurvivantController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Survivants/index.html.twig');
    }
}
