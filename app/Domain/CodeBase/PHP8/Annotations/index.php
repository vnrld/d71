<?php

declare(strict_types=1);

namespace PHP8\Annotations;

use PHP8\Annotations\Application\App;

/**
 * @var App $app
 */
$app = require __DIR__ . '/bootstrap.php';
$response = $app->makeHttpRequest();

echo $response . PHP_EOL . PHP_EOL;

