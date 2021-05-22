<?php

declare(strict_types=1);

namespace PHP8\Annotations\Http\Controllers;

use PHP8\Annotations\Http\Responses\Response;
use PHP8\Annotations\Http\Router\Route;
use PHP8\Annotations\Repositories\PostsRepository;

class PostsController extends Controller
{

    protected string $repositoryClass = PostsRepository::class;

    #[Route("/posts", methods: ["GET"])]
    public function getPosts(): Response
    {
        return new Response(['users' => $this->getRepository()->getAll(), 'count' => $this->getRepository()->count()]);
    }

    #[Route("/posts/{id}", methods: ["GET"])]
    public function getPost(string $id): Response
    {
        return new Response(['user' => $this->getRepository()->getById($id)]);
    }

}
