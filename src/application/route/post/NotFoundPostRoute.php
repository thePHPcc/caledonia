<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\http\Command;
use example\framework\http\PostRequest;
use example\framework\http\PostRequestRoute;

final readonly class NotFoundPostRoute implements PostRequestRoute
{
    public function route(PostRequest $request): Command
    {
        return new NotFoundCommand;
    }
}
