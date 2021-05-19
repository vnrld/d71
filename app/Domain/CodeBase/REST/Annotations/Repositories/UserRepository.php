<?php

declare(strict_types=1);

namespace REST\Annotations\Repositories;

class UserRepository extends Repository
{
    protected array $data = [
        [
            'id' => '',
            'name' => 'User 1'
        ],
        [
            'id' => '',
            'name' => 'User 2'
        ],
    ];

    public function get(?string $id = null): array
    {
        if ($id === null) {
            return $this->data;
        }

        $arrayKey = array_search($id, array_column($this->data, 'id'));

        var_dump($arrayKey);

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
}
