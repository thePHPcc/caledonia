<?php declare(strict_types=1);
namespace example\framework\http;

final readonly class GetRequestRouter
{
    /**
     * @psalm-var list<GetRequestRoute>
     */
    private array $routes;

    public function __construct(GetRequestRoute ...$routes)
    {
        $this->routes = $routes;
    }

    /**
     * @throws RequestCannotBeRoutedException
     */
    public function route(GetRequest $request): Query
    {
        foreach ($this->routes as $route) {
            $query = $route->route($request);

            if ($query !== false) {
                return $query;
            }
        }

        throw new RequestCannotBeRoutedException;
    }
}
