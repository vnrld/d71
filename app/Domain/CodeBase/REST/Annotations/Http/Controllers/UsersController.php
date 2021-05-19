<?php

declare(strict_types=1);

namespace REST\Annotations\Http\Controllers;

use REST\Annotations\Http\Responses\Response;
use REST\Annotations\Http\Router\Route;
use REST\Annotations\Repositories\UserRepository;

class UsersController extends Controller
{
    protected string $repositoryClass = UserRepository::class;

    #[Route("/users", methods: ["GET"])]
    public function getUsers(): Response
    {
        print_r($this->getRepository()->get());
    }

    #[Route("/users/{id}", methods: ["GET"])]
    public function getUser(string $id): Response
    {
        print_r($this->getRepository()->get($id));
    }

}
