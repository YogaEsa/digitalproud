<?php

// Check for Secret Key to prevent unauthorized execution
// Make sure to set DEPLOY_KEY in your GitHub Secrets and pass it as a query param: ?key=YOUR_SECRET
$validKey = isset($_GET['key']) && !empty($_GET['key']);
// You can hardcode a fallback key here if env is not reliable in this context, or prefer strict checking
// For security, checking against a known value is best.
// Since we don't handle `.env` parsing manually here (Laravel handles it), we can blindly accept if a key is provided,
// OR better: check against a value we expect.
// But we don't want to hardcode the secret in the repo.
// So we will rely on an environment variable OR just trust that if the file exists it's temporary?
// NO, this file stays. So we need security.
// We will look for a file `../.deploy_secret` or similar? No that's complex.
// How about checking against `env('DEPLOY_KEY')` after bootstrap? Yes.

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

// Security Check
$deployKey = env('DEPLOY_KEY');
$requestKey = $_GET['key'] ?? null;

if (!$deployKey || $deployKey !== $requestKey) {
    http_response_code(403);
    echo "Forbidden: Invalid or missing DEPLOY_KEY.";
    exit;
}

try {
    echo "<h1>Migration Status</h1>";
    echo "<pre>";
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    echo \Illuminate\Support\Facades\Artisan::output();
    echo "</pre>";
    echo "<p>Migration Completed.</p>";
} catch (\Exception $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
