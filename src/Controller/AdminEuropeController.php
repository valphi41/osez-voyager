<?php

namespace App\Controller;

use App\Model\EuropeManager;
use App\Model\FileManager;

class AdminEuropeController extends AbstractController
{
    public function index(): string
    {
        $europesManager = new EuropeManager();
        $europes = $europesManager->selectAll();

        return $this->twig->render('Admin/Europe/index.html.twig', [
            'europes' => $europes,
        ]);
    }
    public function add(): ?string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $europe = array_map('trim', $_POST);


            if (strlen($europe['title']) < 10) {
                $errors[] = 'Un titre a besoin de plus de 10 caractères.';
            }

            if (empty($europe['country'])) {
                $errors[] = 'Le champ pays est vide.';
            }

            if (empty($europe['content'])) {
                $errors[] = 'Le champ content est vide.';
            }

            if (empty($europe['danger'])) {
                $errors[] = 'Le champ danger est vide.';
            }

            // if validation is ok, insert and redirection
            if (empty($errors)) {
                $europeManager = new EuropeManager();
                $europe = $europeManager->insert($europe);

                header('Location:/europe/index');
                return null;
            }
        }
        return $this->twig->render('Admin/Europe/add.html.twig', [
            'errors' => $errors
        ]);
    }
    public function edit(int $id): ?string
    {
        $europeManager = new EuropeManager();
        $europe = $europeManager->selectOneById($id);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $europe = array_map('trim', $_POST);

            $errors = [];
            // TODO validations (length, format...)
            if (strlen($europe['title']) < 10) {
                $errors[] = 'Un événement a besoin de plus de 10 caractères.';
            }

            if (empty($europe['country'])) {
                $errors[] = 'Le champ texte est vide.';
            }
            if (empty($europe['content'])) {
                $errors[] = 'Le champ content est vide.';
            }


            // if validation is ok, update and redirection
            if (empty($errors)) {
                $europeManager->update($europe);
                header('Location: /europe/index');

                // we are redirecting so we don't want any content rendered
                return null;
            }
        }

        return $this->twig->render('Admin/Europe/edit.html.twig', [
            'errors' => $errors, 'europe' => $europe
        ]);
    }
    public function delete(int $id): void
    {
        $europeManager = new EuropeManager();
        $europeManager->delete((int)$id);

        header('Location:/europe/index');
    }
}
