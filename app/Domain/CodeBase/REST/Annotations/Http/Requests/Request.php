<?php

declare(strict_types=1);

namespace REST\Annotations\Http\Requests;

class Request
{
    private array $server;

    public function __construct(array $server)
    {
        $this->server = $server;
    }

    public function getPath(): string
    {
        return $this->server['HTTP_INFO'] ?? $this->server['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }
}
