<?php

declare(strict_types=1);

namespace PHP8\Annotations\Http\Controllers;

use PHP8\Annotations\Http\Responses\Response;
use PHP8\Annotations\Http\Router\Route;
use PHP8\Annotations\Repositories\UsersRepository;

class UsersController extends Controller
{
    protected string $repositoryClass = UsersRepository::class;

    #[Route("/users", methods: ["GET"])]
    public function getUsers(): Response
    {
        return new Response(['users' => $this->getRepository()->getAll(), 'count' => $this->getRepository()->count()]);
    }

    #[Route("/users/{id}", methods: ["GET"])]
    public function getUser(string $id): Response
    {
        return new Response(['user' => $this->getRepository()->getById($id)]);
    }

}
