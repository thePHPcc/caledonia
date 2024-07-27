<?php declare(strict_types=1);
namespace example\framework\http;

/**
 * @no-named-arguments
 */
interface GetRequestRoute
{
    public function route(GetRequest $request): false|Query;
}
