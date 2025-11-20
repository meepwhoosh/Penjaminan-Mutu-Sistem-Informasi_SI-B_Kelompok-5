<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$items = \App\Models\Hewan::all(['id','nama','foto'])->toArray();
if (empty($items)) {
    echo "No hewan records\n";
    exit;
}
foreach ($items as $h) {
    echo "ID: {$h['id']} | Nama: {$h['nama']} | Foto: " . ($h['foto'] ?? '(null)') . "\n";
}
