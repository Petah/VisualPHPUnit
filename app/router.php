<?php
// Get requested file/URI
$request = $_SERVER['REQUEST_URI'];

// Remove excess leading slashes
$request = ltrim($request, '/');

// Should attempt to prevent directory traversal here...

$file = __DIR__ . '/public/' . $request;

if (is_file($file)) {
    $types = array(
        'css' => 'text/css',
        'js' => 'text/js',
        'gif' => 'image/gif',
        'png' => 'image/png',
    );
    $info = new SplFileInfo($file);
    if (isset($types[$info->getExtension()])) {
        header('Content-Type: ' . $types[$info->getExtension()]);
    }
    readfile($file);
} else {
    // Correct the script file name
    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';

    // Require the HTTP bootstrap
    require __DIR__ . '/public/index.php';
}
