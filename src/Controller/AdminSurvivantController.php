<?php

namespace App\Controller;

use App\Model\SurvivantManager;
use App\Model\FileManager;

class AdminSurvivantController extends AbstractController
{
    public function index(): string
    {
        $survivantsManager = new SurvivantManager();
        $survivants = $survivantsManager->selectAll();

        return $this->twig->render('Admin/Survivant/index.html.twig', [
            'survivants' => $survivants,
        ]);
    }
    public function add(): ?string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $survivant = array_map('trim', $_POST);


            if (strlen($survivant['name']) < 5) {
                $errors[] = 'Un nom a besoin de plus de 5 caractères.';
            }

            if (empty($survivant['content'])) {
                $errors[] = 'Le champ content est vide.';
            }

            if (empty($survivant['image'])) {
                $errors[] = 'Le champ image est vide.';
            }

            // if validation is ok, insert and redirection
            if (empty($errors)) {
                $survivantManager = new SurvivantManager();
                $survivant = $survivantManager->insert($survivant);

                header('Location:/survivant/index');
                return null;
            }
        }
        return $this->twig->render('Admin/Survivant/add.html.twig', [
            'errors' => $errors
        ]);
    }
    public function edit(int $id): ?string
    {
        $survivantManager = new SurvivantManager();
        $survivant = $survivantManager->selectOneById($id);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $survivant = array_map('trim', $_POST);

            $errors = [];
            // TODO validations (length, format...)
            if (strlen($survivant['name']) < 5) {
                $errors[] = 'Un nom a besoin de plus de 5 caractères.';
            }

            if (empty($survivant['content'])) {
                $errors[] = 'Le champ content est vide.';
            }

            if (empty($survivant['image'])) {
                $errors[] = 'Le champ image est vide.';
            }


            // if validation is ok, update and redirection
            if (empty($errors)) {
                $survivantManager->update($survivant);
                header('Location: /survivant/index');

                // we are redirecting so we don't want any content rendered
                return null;
            }
        }

        return $this->twig->render('Admin/Survivant/edit.html.twig', [
            'errors' => $errors, 'survivant' => $survivant
        ]);
    }
    public function delete(int $id): void
    {
        $survivantManager = new SurvivantManager();
        $survivantManager->delete((int)$id);

        header('Location:/survivant/index');
    }
}
