<?php

use App\Models\Menu;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

// Update all menus with category "cookies" to "Cookies"
Menu::where('category', 'cookies')->update(['category' => 'Cookies']);

echo "Updated categories from 'cookies' to 'Cookies'.\n";

// Verify
$cookies = Menu::where('category', 'Cookies')->get();
foreach ($cookies as $cookie) {
    echo "- " . $cookie->name . " (" . $cookie->category . ")\n";
}
