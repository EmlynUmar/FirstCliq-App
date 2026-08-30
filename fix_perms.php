<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

function fixPermissions($dir) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    $count = 0;
    foreach ($iterator as $item) {
        if ($item->isDir()) {
            chmod($item->getPathname(), 0755);
        } else {
            chmod($item->getPathname(), 0644);
        }
        $count++;
    }
    return $count;
}

$dir = __DIR__;
echo "<h1>Fixing Permissions</h1>";
echo "Starting to fix permissions in: $dir<br>";

try {
    $filesFixed = fixPermissions($dir);
    echo "<h2 style='color:green;'>Success! Fixed permissions for $filesFixed files and folders!</h2>";
    echo "<p>Directories are now 0755 and files are 0644. You can now try logging into your website again.</p>";
} catch (Exception $e) {
    echo "<h2 style='color:red;'>Error: " . $e->getMessage() . "</h2>";
}
?>
