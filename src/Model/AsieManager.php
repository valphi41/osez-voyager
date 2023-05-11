<?php

namespace App\Model;

use PDO;

class AsieManager extends AbstractManager
{
    public const TABLE = 'asie';

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        return parent::selectAll($orderBy, $direction);
    }

    public function insert(array $asie): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`,`country`,`content`,`danger`)
    VALUES (:title, :country, :content, :danger)");
        $statement->bindValue('title', $asie['title'], PDO::PARAM_STR);
        $statement->bindValue('country', $asie['country'], PDO::PARAM_STR);
        $statement->bindValue('content', $asie['content'], PDO::PARAM_STR);
        $statement->bindValue('danger', $asie['danger'], PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
