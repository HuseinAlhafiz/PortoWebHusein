<?php
$base = dirname(__DIR__);
$shortcut = $base . '/public/storage';
$target = $base . '/storage/app/public';

header('Content-Type: text/plain');

echo "Base path: $base\n";
echo "Shortcut: $shortcut\n";
echo "Target: $target\n\n";

if (file_exists($shortcut) || is_link($shortcut)) {
    if (is_dir($shortcut) && !is_link($shortcut)) {
        echo "public/storage is a real directory (uploaded via FTP). Deleting contents first...\n";
        
        function rmDirRf($dir) {
            foreach (glob($dir . '/*') as $file) {
                if (is_dir($file)) {
                    rmDirRf($file);
                } else {
                    @unlink($file);
                }
            }
            return @rmdir($dir);
        }
        
        if (rmDirRf($shortcut)) {
            echo "Successfully deleted public/storage directory.\n";
        } else {
            echo "Failed to delete public/storage directory!\n";
        }
    } else {
        echo "public/storage is a symbolic link or file. Unlinking it...\n";
        if (@unlink($shortcut)) {
            echo "Successfully unlinked old public/storage shortcut.\n";
        } else {
            echo "Failed to unlink old public/storage shortcut!\n";
        }
    }
}

echo "Creating new symbolic link...\n";
if (symlink($target, $shortcut)) {
    echo "Symlink created successfully!\n";
} else {
    echo "Failed to create symlink!\n";
}

// Self-destruct after running to keep it secure
@unlink(__FILE__);
