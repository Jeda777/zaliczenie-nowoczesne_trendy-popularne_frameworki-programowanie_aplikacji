<?php

class Message
{
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT id, content, timestamp, username FROM message");
        return $stmt->fetchAll();
    }

    public function findById(int $id) {
        $stmt = $this->pdo->prepare("SELECT id, content, timestamp, username FROM message WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data) {
        $stmt = $this->pdo->prepare("INSERT INTO message (content, timestamp, username) VALUES (:message, :timestamp, :username)");
        $stmt->execute([
            ':username' => $data['username'],
            ':timestamp' => time(),
            ':message' => $data['message']
        ]);
        return $this->pdo->lastInsertId();
    }
}

?>