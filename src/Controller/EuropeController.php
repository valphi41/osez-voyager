<?php

namespace App\Controller;

use App\Model\EuropeManager;

class EuropeController extends AbstractController
{
    public function index(): string
    {
        $europeManager = new EuropeManager();
        $europes = $europeManager->selectAll();

        return $this->twig->render('Europe/index.html.twig', [
            'europes' => $europes
        ]);
    }
}
