<?php

class Message
{
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT m.id, m.content, m.timestamp, u.username FROM message m JOIN user u ON m.userId = u.id ORDER BY m.timestamp DESC");
        return $stmt->fetchAll();
    }

    public function findById(int $id) {
        $stmt = $this->pdo->prepare("SELECT id, content, timestamp, userId FROM message WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data) {
        $stmt = $this->pdo->prepare("INSERT INTO message (content, timestamp, userId) VALUES (:message, :timestamp, :userId)");
        $stmt->execute([
            ':userId' => $data['userId'],
            ':timestamp' => time(),
            ':message' => $data['message']
        ]);
        return $this->pdo->lastInsertId();
    }
}

?>