<?php

$dbPath = __DIR__ . '/../../db.db';

try {
    $pdo = new PDO("sqlite:" . $dbPath);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych SQLite: " . $e->getMessage());
}

?>