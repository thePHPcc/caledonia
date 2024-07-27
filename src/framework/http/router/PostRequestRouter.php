<?php declare(strict_types=1);
namespace example\framework\http;

/**
 * @no-named-arguments
 */
final readonly class PostRequestRouter
{
    /**
     * @var list<PostRequestRoute>
     */
    private array $routes;

    public function __construct(PostRequestRoute ...$routes)
    {
        $this->routes = $routes;
    }

    /**
     * @throws RequestCannotBeRoutedException
     */
    public function route(PostRequest $request): Command
    {
        foreach ($this->routes as $route) {
            $command = $route->route($request);

            if ($command !== false) {
                return $command;
            }
        }

        throw new RequestCannotBeRoutedException;
    }
}
