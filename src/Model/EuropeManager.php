<?php

namespace App\Model;

use PDO;

class EuropeManager extends AbstractManager
{
    public const TABLE = 'europe';

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        return parent::selectAll($orderBy, $direction);
    }

    public function insert(array $europe): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`,`country`,`content`,`danger`)
    VALUES (:title, :country, :content, :danger)");
        $statement->bindValue('title', $europe['title'], PDO::PARAM_STR);
        $statement->bindValue('country', $europe['country'], PDO::PARAM_STR);
        $statement->bindValue('content', $europe['content'], PDO::PARAM_STR);
        $statement->bindValue('danger', $europe['danger'], PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
