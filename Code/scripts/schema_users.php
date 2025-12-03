<?php
$path = realpath(__DIR__ . '/../database/database.sqlite');
if (! $path) { echo "SQLite file not found\n"; exit(1); }
try {
    $pdo = new PDO('sqlite:' . $path);
    $stmt = $pdo->query("PRAGMA table_info('users')");
    $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($cols)) { echo "Table users not found or has no columns\n"; exit(0); }
    foreach ($cols as $c) {
        echo sprintf("%d: %s %s (pk=%s, notnull=%s, dflt=%s)\n", $c['cid'], $c['name'], $c['type'], $c['pk'], $c['notnull'], $c['dflt_value']);
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL; exit(1);
}
