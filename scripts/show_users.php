<?php
require __DIR__ . '/../vendor/autoload.php';

$path = realpath(__DIR__ . '/../database/database.sqlite');
if (! $path) {
    echo "SQLite file not found\n";
    exit(1);
}
try {
    $pdo = new PDO('sqlite:' . $path);
    $stmt = $pdo->query("SELECT id, nama, email, role, created_at FROM users ORDER BY id DESC LIMIT 10");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) {
        echo "No users found\n";
        exit(0);
    }
    foreach ($rows as $r) {
        echo sprintf("%s | %s | %s | %s | %s\n", $r['id'], $r['nama'], $r['email'], ($r['role'] ?? 'NULL'), ($r['created_at'] ?? 'NULL'));
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
    exit(1);
}
