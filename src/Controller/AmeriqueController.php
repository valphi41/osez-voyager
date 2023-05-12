<?php

namespace App\Controller;

use App\Model\AmeriqueManager;

class AmeriqueController extends AbstractController
{
    public function index(): string
    {
        $ameriqueManager = new AmeriqueManager();
        $ameriques = $ameriqueManager->selectAll();

        return $this->twig->render('Amerique/index.html.twig', [
            'ameriques' => $ameriques
        ]);
    }
}
