<?php

class User
{
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function findById(int $id) {
        $stmt = $this->pdo->prepare("SELECT id, username, password FROM user WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function findByUsername(string $username) {
        $stmt = $this->pdo->prepare("SELECT id, username, password FROM user WHERE username = :username");
        $stmt->execute([':username' => $username]);
        return $stmt->fetch();
    }

    public function create(array $data) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
            $stmt->execute([
                ':username' => $data['username'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT)
            ]);
            return $this->pdo->lastInsertId();
        } catch (\Throwable $th) {
            error_log("Error creating user: " . $th->getMessage());
            return null;
        }
        return null;
    }
}

?>