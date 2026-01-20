<?php

$zipFile = 'release.zip';
// We are in public/, so project root is one level up
$projectRoot = __DIR__ . '/../';
$zipPath = $projectRoot . $zipFile;

if (!file_exists($zipPath)) {
    http_response_code(404);
    echo "Error: $zipFile not found at $zipPath";
    exit;
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
