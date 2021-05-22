<?php

declare(strict_types=1);

namespace PHP8\Annotations\Http\Router;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION | Attribute::IS_REPEATABLE)]
class Route
{
    private string $path;

    private array $methods;

    private array $routeParameters;

    public function __construct(string $path, array $methods)
    {
        $this->path = $path;
        $this->methods = $methods;
    }

    public function hasValidPath(string $path): bool
    {
        $printable = '[0-9a-zA-Z-]+';

        $pattern = preg_replace('/{' . $printable . '}/', '(' . $printable . ')', $this->path);

        if (!str_contains($pattern, '(' . $printable . ')')) {
            return $this->path === $path;
        }

        $matches = [];
        $found = preg_match('#' . $pattern  .'#', $path, $matches);

        unset($matches[0]);
        $this->routeParameters = $matches;

        return (bool)$found;
    }

    public function hasValidMethod(string $method): bool
    {
        return in_array($method, $this->methods, true);
    }

    public function getRouteParameters(): array
    {
        return array_values($this->routeParameters);
    }
}
