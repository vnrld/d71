<?php

declare(strict_types=1);

namespace REST\Annotations\Http\Router;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION | Attribute::IS_REPEATABLE)]
class Route
{
    private string $path;

    private array $methods;

    public function __construct(string $path, array $methods) {
        $this->path = $path;
        $this->methods = $methods;
    }

    public function isValidPath(string $path) {
        return $this->path === $path;
    }
}
