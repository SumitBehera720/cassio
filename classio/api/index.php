<?php

// Ensure VERCEL environment flag is set
putenv('VERCEL=1');
$_ENV['VERCEL'] = '1';
$_SERVER['VERCEL'] = '1';

// Create required writable directories in serverless /tmp
$tmpDirs = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Copy SQLite database from read-only filesystem to /tmp so Laravel can read & write
$repoDb = __DIR__ . '/../database/database.sqlite';
$tmpDb = '/tmp/database.sqlite';

if (file_exists($repoDb) && !file_exists($tmpDb)) {
    copy($repoDb, $tmpDb);
}

if (file_exists($tmpDb)) {
    putenv('DB_CONNECTION=sqlite');
    putenv('DB_DATABASE=' . $tmpDb);
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = $tmpDb;
    $_SERVER['DB_CONNECTION'] = 'sqlite';
    $_SERVER['DB_DATABASE'] = $tmpDb;
}

// Forward execution to Laravel's public entrypoint
require __DIR__ . '/../public/index.php';
