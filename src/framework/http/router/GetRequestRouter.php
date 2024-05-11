<?php declare(strict_types=1);
namespace example\framework\http;

use function array_values;

final readonly class GetRequestRouter
{
    /**
     * @var list<GetRequestRoute>
     */
    private array $routes;

    public function __construct(GetRequestRoute ...$routes)
    {
        $this->routes = array_values($routes);
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
