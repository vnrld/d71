<?php

declare(strict_types=1);

namespace PHP8\Annotations\Repositories;

class PostsRepository extends Repository
{
    protected array $data = [
        [
            'id' => '1',
            'title' => 'Post 1',
            'published' => '2021-05-21 15:32:33'
        ],
        [
            'id' => '2',
            'title' => 'Post 2',
            'published' => '2021-05-23 03:32:33'
        ],
    ];

}
