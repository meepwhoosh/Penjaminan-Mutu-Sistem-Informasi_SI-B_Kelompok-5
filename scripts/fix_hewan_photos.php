<?php
// Script: create placeholder images for seeded hewan and update DB paths
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;
use App\Models\Hewan;

echo "Checking storage folder...\n";
$dir = storage_path('app/public/hewan');
if (! is_dir($dir)) {
    mkdir($dir, 0777, true);
    echo "Created folder: $dir\n";
}

$placeholderBase64 = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII='; // 1x1 PNG
$placeholderBin = base64_decode($placeholderBase64);

$items = Hewan::whereNotNull('foto')->get();
if ($items->isEmpty()) {
    echo "No hewan with foto found.\n";
    exit;
}

foreach ($items as $h) {
    $fname = $h->foto;
    if (str_contains($fname, '/')) {
        echo "Skipping (already has path): {$fname}\n";
        continue;
    }
    $target = $dir . DIRECTORY_SEPARATOR . $fname;
    if (!file_exists($target)) {
        file_put_contents($target, $placeholderBin);
        echo "Created placeholder for: {$fname}\n";
    } else {
        echo "File exists: {$fname}\n";
    }

    // update DB path to include folder prefix
    $newPath = 'hewan/' . $fname;
    $h->foto = $newPath;
    $h->save();
    echo "Updated DB foto path to: {$newPath}\n";
}

echo "Done.\n";
