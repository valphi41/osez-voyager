<?php

namespace App\Controller;

use App\Model\AsieManager;
use App\Model\FileManager;

class AdminAsieController extends AbstractController
{
    public function index(): string
    {
        $asiesManager = new AsieManager();
        $asies = $asiesManager->selectAll();

        return $this->twig->render('Admin/Asie/index.html.twig', [
            'asies' => $asies,
        ]);
    }
    public function add(): ?string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $asie = array_map('trim', $_POST);


            if (strlen($asie['title']) < 10) {
                $errors[] = 'Un titre a besoin de plus de 10 caractères.';
            }

            if (empty($asie['country'])) {
                $errors[] = 'Le champ pays est vide.';
            }

            if (empty($asie['content'])) {
                $errors[] = 'Le champ content est vide.';
            }

            if (empty($asie['danger'])) {
                $errors[] = 'Le champ danger est vide.';
            }

            // if validation is ok, insert and redirection
            if (empty($errors)) {
                $asieManager = new AsieManager();
                $asie = $asieManager->insert($asie);

                header('Location:/asie/index');
                return null;
            }
        }
        return $this->twig->render('Admin/Asie/add.html.twig', [
            'errors' => $errors
        ]);
    }
    public function edit(int $id): ?string
    {
        $asieManager = new AsieManager();
        $asie = $asieManager->selectOneById($id);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $asie = array_map('trim', $_POST);

            $errors = [];
            // TODO validations (length, format...)
            if (strlen($asie['title']) < 10) {
                $errors[] = 'Un événement a besoin de plus de 10 caractères.';
            }

            if (empty($asie['country'])) {
                $errors[] = 'Le champ texte est vide.';
            }
            if (empty($asie['content'])) {
                $errors[] = 'Le champ content est vide.';
            }


            // if validation is ok, update and redirection
            if (empty($errors)) {
                $asieManager->update($asie);
                header('Location: /asie/index');

                // we are redirecting so we don't want any content rendered
                return null;
            }
        }

        return $this->twig->render('Admin/Asie/edit.html.twig', [
            'errors' => $errors, 'asie' => $asie
        ]);
    }
    public function delete(int $id): void
    {
        $asieManager = new AsieManager();
        $asieManager->delete((int)$id);

        header('Location:/asie/index');
    }
}
