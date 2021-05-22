<?php

declare(strict_types=1);

namespace PHP8\Annotations\Repositories;

abstract class Repository
{
    protected array $data = [];

    public function get(?string $id = null): array
    {
        if ($id === null) {
            return $this->data;
        }

        $arrayKey = array_search($id, array_column($this->data, 'id'));
        return $this->data[$arrayKey];
    }

    public function getById(string $id): array
    {
        return $this->get($id);
    }

    public function getAll(): array
    {
        return $this->get();
    }

    public function count(): int
    {
        return count($this->data);
    }
}
