<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Foundation\Http\Kernel::class);
$aliases = $kernel->getMiddlewareAliases();

echo "Middleware aliases:\n";
foreach ($aliases as $k => $v) {
    echo "$k => $v\n";
}
