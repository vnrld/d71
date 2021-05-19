<?php

declare(strict_types=1);

namespace REST\Annotations\Application;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionMethod;
use REST\Annotations\Http\Requests\Request;
use REST\Annotations\Http\Responses\Response;
use REST\Annotations\Http\Router\Route;

class App
{
    protected Request $request;

    protected string $controllersDirectory;

    protected array $routes;

    public function __construct(array $server)
    {
        $this->request = new Request($server);
    }

    /**
     * @return string
     */
    public function getControllersDirectory(): string
    {
        return $this->controllersDirectory;
    }

    /**
     * @param string $controllersDirectory
     * @return App
     */
    public function setControllersDirectory(string $controllersDirectory): App
    {
        $this->controllersDirectory = $controllersDirectory;
        return $this;
    }

    public function makeHttpRequest(): Response
    {
        /**
         * @var RecursiveDirectoryIterator $iterator
         */
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->controllersDirectory));

        $iterator->rewind();
        while ($iterator->valid()) {

            $className = $iterator->getBasename('.php');

            if (str_ends_with($className, 'Controller')) {
                $class = 'REST\Annotations\Http\Controllers\\' . $className;

                $reflection = new ReflectionClass($class);

                $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

                foreach ($methods as $method) {
                    $attributes = $method->getAttributes();

                    if (count($attributes) > 0) {
                        foreach ($attributes as $attribute) {

                            $routeClass = $attribute->getName();
                            /**
                             * @var Route $route
                             */
                            $route = new $routeClass(...$attribute->getArguments());

                            if ($route->isValidPath($this->request->getPath())) {
                                $invokeMethod = $method->getName();
                                $controller = new $class($this);
                                return $controller->$invokeMethod();
                            }
                        }
                    }
                }

            }

            $iterator->next();
        }

        return new Response('Invalid!');
    }
}
