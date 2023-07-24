<?php
$envFile = dirname(__DIR__) . '/.env';

if (file_exists($envFile)) {
    $envContent = file_get_contents($envFile);
    $envLines   = explode("\n", $envContent);

    foreach ($envLines as $line) {
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key   = trim($parts[0]);
            $value = trim($parts[1]);
            putenv("$key=$value");
        }
    }
}
?>