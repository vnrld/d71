<?php

declare(strict_types=1);

use REST\Annotations\Application\App;

// Use default autoload implementation
spl_autoload_register(
    function (string $class): void {
        $class = __DIR__ . '/../../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        require_once $class;
    }
);

$app = new App($_SERVER);
$app->setControllersDirectory(__DIR__ . '/Http/Controllers');

return $app;
