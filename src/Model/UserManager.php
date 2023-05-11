<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectOneByEmail(string $email)
    {
        $query = "SELECT * FROM " . self::TABLE . " WHERE email=:email";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        return $statement->fetch();
    }

    public function insert(array $credentials): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`email`, `password`) VALUES (:email, :password)");
        $statement->bindValue(':email', $credentials['email']);
        $statement->bindValue(':password', password_hash($credentials['password'], PASSWORD_DEFAULT));
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
