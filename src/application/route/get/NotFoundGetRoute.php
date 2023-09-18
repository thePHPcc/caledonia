<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\http\GetRequest;
use example\framework\http\GetRequestRoute;
use example\framework\http\Query;

final readonly class NotFoundGetRoute implements GetRequestRoute
{
    public function route(GetRequest $request): Query
    {
        return new NotFoundQuery;
    }
}
