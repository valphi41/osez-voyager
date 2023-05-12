<?php

namespace App\Model;

use PDO;

class FileManager extends AbstractManager
{
    public const TABLE = 'file';

    public function insertSurvivant(string $fileName, int $survivantId): int
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET position=position+1 WHERE survivant_id=:survivant_id");
        $statement->bindValue('survivant_id', $survivantId, PDO::PARAM_STR);
        $statement->execute();

        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `survivant_id`, `position`)
         VALUES (:name, :survivant_id, 1)");
        $statement->bindValue('name', $fileName, PDO::PARAM_STR);
        $statement->bindValue('survivant_id', $survivantId, PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function selectAllBysurvivantId(int $survivantId)
    {
        $query = 'SELECT * FROM ' . static::TABLE . ' WHERE survivant_id= :survivant_id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':survivant_id', $survivantId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function deleteSurvivant(int $id): void
    {
        $file = $this->selectOneById($id);
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET position=position-1 WHERE position>:position AND survivant_id=:survivant_id");
        $statement->bindValue('survivant_id', $file['survivant_id'], PDO::PARAM_INT);
        $statement->bindValue('position', $file['position'], PDO::PARAM_INT);
        $statement->execute();
        parent::delete($id);
    }
    public function deleteAllBySurvivantId(int $survivantId): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE survivant_id=:survivant_id");
        $statement->bindValue('survivant_id', $survivantId, PDO::PARAM_INT);
        $statement->execute();
    }
}
