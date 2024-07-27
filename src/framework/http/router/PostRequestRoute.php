<?php declare(strict_types=1);
namespace example\framework\http;

/**
 * @no-named-arguments
 */
interface PostRequestRoute
{
    public function route(PostRequest $request): Command|false;
}
