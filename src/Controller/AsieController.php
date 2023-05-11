<?php

namespace App\Controller;

use App\Model\AsieManager;

class AsieController extends AbstractController
{
    public function index(): string
    {
        $asieManager = new AsieManager();
        $asies = $asieManager->selectAll();

        return $this->twig->render('Asie/index.html.twig', [
            'asies' => $asies
        ]);
    }
}
