<?php

namespace App\Model;

use PDO;

class AmeriqueManager extends AbstractManager
{
    public const TABLE = 'amerique';

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $ameriques = parent::selectAll($orderBy, $direction);
        $fileManager = new FileManager();
        foreach ($ameriques as &$amerique) {
            $amerique['files'] = $fileManager->selectAllBysurvivantId($amerique['id']);
        }
        return $ameriques;
    }

    public function insert(array $amerique): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (title, country, content , danger )
    VALUES (:title, :country, :content, :danger)");
        $statement->bindValue('title', $amerique['title'], PDO::PARAM_STR);
        $statement->bindValue('country', $amerique['country'], PDO::PARAM_STR);
        $statement->bindValue('content', $amerique['content'], PDO::PARAM_STR);
        $statement->bindValue('danger', $amerique['danger'], PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
    public function update(array $amerique): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `title` = :title, `country` = :country, `content` = :content, `danger` = :danger WHERE id=:id");
        $statement->bindValue('id', $amerique['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $amerique['title'], PDO::PARAM_STR);
        $statement->bindValue('country', $amerique['country'], PDO::PARAM_STR);
        $statement->bindValue('content', $amerique['content'], PDO::PARAM_STR);
        $statement->bindValue('danger', $amerique['danger'], PDO::PARAM_INT);

        return $statement->execute();
    }
    public function delete(int $id): void
    {
        $fileManager = new FileManager();
        $fileManager->deleteAllByAmeriqueId($id);
        parent::delete($id);
    }
}
