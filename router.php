<?php
/**
 * Router for PHP built-in server (development only).
 * Usage: php -S localhost:8000 router.php
 */
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Block access to internal directories (BEFORE serving static files)
if (preg_match('#^/(content|config|components|templates|\.context)/#', $path)) {
    http_response_code(403);
    echo 'Forbidden';
    return true;
}

// Serve static files directly
$file = __DIR__ . $path;
if ($path !== '/' && is_file($file)) {
    // Set proper content types
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $types = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'json' => 'application/json',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
        'webp' => 'image/webp',
        'svg'  => 'image/svg+xml',
        'ico'  => 'image/x-icon',
        'xml'  => 'application/xml',
        'txt'  => 'text/plain',
    ];
    if (isset($types[$ext])) {
        header('Content-Type: ' . $types[$ext]);
    }
    return false; // Let the built-in server handle it
}

// Route everything else through index.php
include __DIR__ . '/index.php';
