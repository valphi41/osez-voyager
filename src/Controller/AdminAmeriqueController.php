<?php

namespace App\Controller;

use App\Model\AmeriqueManager;
use App\Model\FileManager;

class AdminAmeriqueController extends AbstractController
{
    public function index(): string
    {
        $ameriquesManager = new AmeriqueManager();
        $ameriques = $ameriquesManager->selectAll();

        return $this->twig->render('Admin/Amerique/index.html.twig', [
            'ameriques' => $ameriques,
        ]);
    }
    public function add(): ?string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $amerique = array_map('trim', $_POST);


            if (strlen($amerique['title']) < 10) {
                $errors[] = 'Un titre a besoin de plus de 10 caractères.';
            }

            if (empty($amerique['country'])) {
                $errors[] = 'Le champ pays est vide.';
            }

            if (empty($amerique['content'])) {
                $errors[] = 'Le champ content est vide.';
            }

            if (empty($amerique['danger'])) {
                $errors[] = 'Le champ danger est vide.';
            }

            // if validation is ok, insert and redirection
            if (empty($errors)) {
                $ameriqueManager = new AmeriqueManager();
                $amerique = $ameriqueManager->insert($amerique);

                header('Location:/amerique/index');
                return null;
            }
        }
        return $this->twig->render('Admin/Amerique/add.html.twig', [
            'errors' => $errors
        ]);
    }
    public function edit(int $id): ?string
    {
        $ameriqueManager = new AmeriqueManager();
        $amerique = $ameriqueManager->selectOneById($id);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $amerique = array_map('trim', $_POST);

            $errors = [];
            // TODO validations (length, format...)
            if (strlen($amerique['title']) < 10) {
                $errors[] = 'Un événement a besoin de plus de 10 caractères.';
            }

            if (empty($amerique['country'])) {
                $errors[] = 'Le champ texte est vide.';
            }
            if (empty($amerique['content'])) {
                $errors[] = 'Le champ content est vide.';
            }


            // if validation is ok, update and redirection
            if (empty($errors)) {
                $ameriqueManager->update($amerique);
                header('Location: /amerique/index');

                // we are redirecting so we don't want any content rendered
                return null;
            }
        }
        $fileManager = new FileManager();
        return $this->twig->render('Admin/Amerique/edit.html.twig', [
            'errors' => $errors,
            'amerique' => $amerique,
            'files' => $fileManager->selectAllByameriqueId($id),
        ]);
    }
    public function delete(int $id): void
    {
        $ameriqueManager = new AmeriqueManager();
        $ameriqueManager->delete((int)$id);

        header('Location:/amerique/index');
    }
    public function addFiles()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadsDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir);
            }
            $ameriqueId = $_POST['amerique_id'];
            $fileManager = new FileManager();
            foreach ($_FILES['files']['tmp_name'] as $index => $tmpName) {
                $fileName = $_FILES['files']['name'][$index];
                if (move_uploaded_file($tmpName, $uploadsDir . $fileName)) {
                    $fileManager->insertAmerique($fileName, $ameriqueId);
                }
            }
            header('Location: /amerique/edit?id=' . $ameriqueId);
        }
    }
    public function deleteFile(int $id)
    {
        $fileManager = new FileManager();
        $file = $fileManager->selectOneById($id);
        if (unlink(__DIR__ . '/../../public/uploads/' . $file['name'])) {
            $fileManager->delete($id);
        }
        header('Location: /amerique/edit?id=' . $file['amerique_id']);
    }
}
