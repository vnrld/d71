<?php

declare(strict_types=1);

namespace PHP8\Annotations\Repositories;

class UsersRepository extends Repository
{
    protected array $data = [
        [
            'id' => '123e4567-e89b-12d3-a456-426614174000',
            'name' => 'User 1'
        ],
        [
            'id' => '123e4567-e89b-12d3-a456-426614174001',
            'name' => 'User 2'
        ],
    ];
}
