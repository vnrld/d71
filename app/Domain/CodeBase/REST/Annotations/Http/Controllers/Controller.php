<?php

declare(strict_types=1);

namespace REST\Annotations\Http\Controllers;

use REST\Annotations\Application\App;
use REST\Annotations\Http\Responses\Response;
use REST\Annotations\Http\Router\Route;
use REST\Annotations\Repositories\Repository;

class Controller
{
    protected App $app;

    protected string $repositoryClass;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    #[Route("/healthcheck", methods: ["GET"])]
    #[Route("/", methods: ["GET"])]
    public function healthcheck(): Response
    {
        return new Response(['http_code' => 200, 'status' => 'OK']);
    }

    protected function getRepository(): Repository
    {
        return new $this->repositoryClass;
    }
}
