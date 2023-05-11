<?php

namespace App\Model;

use PDO;

class AmeriqueManager extends AbstractManager
{
    public const TABLE = 'amerique';

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        return parent::selectAll($orderBy, $direction);
    }

    public function insert(array $amerique): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`,`country`,`content`,`danger`)
    VALUES (:title, :country, :content, :danger)");
        $statement->bindValue('title', $amerique['title'], PDO::PARAM_STR);
        $statement->bindValue('country', $amerique['country'], PDO::PARAM_STR);
        $statement->bindValue('content', $amerique['content'], PDO::PARAM_STR);
        $statement->bindValue('danger', $amerique['danger'], PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
