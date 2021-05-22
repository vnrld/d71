<?php

declare(strict_types=1);

namespace PHP8\Annotations\Application;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use PHP8\Annotations\Http\Requests\Request;
use PHP8\Annotations\Http\Responses\Response;
use PHP8\Annotations\Http\Router\Route;

/**
 * Class App
 * @package PHP8\Annotations\Application
 */
class App
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var string
     */
    protected string $controllersDirectory;

    /**
     * @var array
     */
    protected array $routes;

    /**
     * App constructor.
     * @param array $server
     */
    public function __construct(array $server)
    {
        $this->request = new Request($server);
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

    /**
     * @return Response
     * @throws ReflectionException
     */
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
                $class = 'PHP8\Annotations\Http\Controllers\\' . $className;

                $reflection = new ReflectionClass($class);

                $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

                foreach ($methods as $method) {
                    // only Route attributes
                    $attributes = $method->getAttributes(Route::class);

                    if (count($attributes) > 0) {
                        foreach ($attributes as $attribute) {
                            $routeClass = $attribute->getName();

                            if (!class_exists($routeClass)) {
                                continue;
                            }

                            /**
                             * @var Route $route
                             */
                            $route = new $routeClass(...$attribute->getArguments());

                            if ($route->hasValidPath($this->request->getPath())) {

                                $requestMethod = $this->request->getMethod();

                                if ($route->hasValidMethod($requestMethod)) {
                                    $invokeMethod = $method->getName();
                                    $controller = new $class($this);

                                    return $controller->$invokeMethod(...$route->getRouteParameters());
                                } else {
                                    return new Response(
                                        'Wrong method ' . $requestMethod . '. Allowed are ' . implode(',', $methods),
                                        Response::HTTP_BAD_REQUEST
                                    );
                                }
                            }
                        }
                    }
                }
            }

            $iterator->next();
        }

        return new Response(
            'No route found for ' . $this->request->getPath(),
            Response::HTTP_BAD_REQUEST
        );
    }
}
