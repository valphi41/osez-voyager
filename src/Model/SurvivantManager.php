<?php

namespace App\Model;

use PDO;

class SurvivantManager extends AbstractManager
{
    public const TABLE = 'survivants';

    public function insert(array $survivant): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`,`content`,`image`)
    VALUES (:name, :content, :image)");
        $statement->bindValue('name', $survivant['name'], PDO::PARAM_STR);
        $statement->bindValue('content', $survivant['content'], PDO::PARAM_STR);
        $statement->bindValue('image', $survivant['image'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
    public function update(array $survivant): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `name` = :name, `content` = :content, `image` = :image WHERE id=:id");
        $statement->bindValue('id', $survivant['id'], PDO::PARAM_INT);
        $statement->bindValue('name', $survivant['name'], PDO::PARAM_STR);
        $statement->bindValue('content', $survivant['content'], PDO::PARAM_STR);
        $statement->bindValue('image', $survivant['image'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
