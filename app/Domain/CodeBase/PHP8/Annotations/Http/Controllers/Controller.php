<?php

declare(strict_types=1);

namespace PHP8\Annotations\Http\Controllers;

use PHP8\Annotations\Application\App;
use PHP8\Annotations\Http\Responses\Response;
use PHP8\Annotations\Http\Router\Route;
use PHP8\Annotations\Repositories\Repository;

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
        return new Response(['status' => 'OK']);
    }

    protected function getRepository(): Repository
    {
        return new $this->repositoryClass;
    }
}
