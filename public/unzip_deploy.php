<?php

$zipFile = 'release.zip';
$projectRoot = __DIR__; // Default to current dir

// Check if we are in public/ (standard Laravel)
if (file_exists(__DIR__ . '/../artisan')) {
    $projectRoot = __DIR__ . '/../';
}

$zipPath = $projectRoot . '/' . $zipFile;

// Clean path
$projectRoot = realpath($projectRoot);
$zipPath = realpath($projectRoot . '/' . $zipFile);

if (!$zipPath || !file_exists($zipPath)) {
    // Try looking in current dir if logic above failed
    if (file_exists(__DIR__ . '/' . $zipFile)) {
        $zipPath = __DIR__ . '/' . $zipFile;
        $projectRoot = __DIR__;
    } else {
        http_response_code(404);
        echo "Error: $zipFile not found. Searched in " . __DIR__ . " and parent.";
        exit;
    }
}

$zip = new ZipArchive;
if ($zip->open($zipPath) === TRUE) {
    // Extract to project root
    $zip->extractTo($projectRoot);
    $zip->close();

    // Cleanup
    unlink($zipPath);

    echo "Success: Deployed and extracted to $projectRoot";
} else {
    http_response_code(500);
    echo "Error opening zip file.";
}
