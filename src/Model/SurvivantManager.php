<?php

namespace App\Model;

use PDO;

class SurvivantManager extends AbstractManager
{
    public const TABLE = 'survivants';

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $survivants = parent::selectAll($orderBy, $direction);
        $fileManager = new FileManager();
        foreach ($survivants as &$survivant) {
            $survivant['files'] = $fileManager->selectAllBysurvivantId($survivant['id']);
        }
        return $survivants;
    }
    public function insert(array $survivant): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`,`content`)
    VALUES (:name, :content)");
        $statement->bindValue('name', $survivant['name'], PDO::PARAM_STR);
        $statement->bindValue('content', $survivant['content'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
    public function update(array $survivant): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `name` = :name, `content` = :content WHERE id=:id");
        $statement->bindValue('id', $survivant['id'], PDO::PARAM_INT);
        $statement->bindValue('name', $survivant['name'], PDO::PARAM_STR);
        $statement->bindValue('content', $survivant['content'], PDO::PARAM_STR);

        return $statement->execute();
    }
    public function delete(int $id): void
    {
        $fileManager = new FileManager();
        $fileManager->deleteAllBySurvivantId($id);
        parent::delete($id);
    }
}
