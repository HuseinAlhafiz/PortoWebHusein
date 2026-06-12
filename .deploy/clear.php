<?php
$base = dirname(__DIR__);

if (function_exists('opcache_reset')) {
    opcache_reset();
}

$viewsPath = $base . '/storage/framework/views';
if (is_dir($viewsPath)) {
    foreach (glob($viewsPath . '/*.php') as $file) {
        @unlink($file);
    }
}

$cachePath = $base . '/storage/framework/cache/data';
if (is_dir($cachePath)) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($cachePath, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    foreach ($iterator as $file) {
        if ($file->isFile()) @unlink($file->getPathname());
    }
}

echo "Done";
@unlink(__FILE__);
