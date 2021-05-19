<?php

declare(strict_types=1);

namespace REST\Annotations\Repositories;

abstract class Repository
{
    protected array $data = [];

    abstract public function getById(string $id): array;

    abstract public function getAll(): array;
}
