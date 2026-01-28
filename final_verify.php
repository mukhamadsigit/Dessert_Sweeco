<?php

use App\Models\Menu;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

$items = Menu::whereNotNull('tags')->get();

echo "=== HASIL UPDATE LABEL MENU ===\n";
foreach ($items as $item) {
    echo "Menu: " . str_pad($item->name, 25) . " | Tags: " . implode(', ', $item->tags) . "\n";
}
