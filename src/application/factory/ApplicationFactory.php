<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\http\GetRequestRouter;
use example\framework\http\Kernel;
use example\framework\http\PostRequestRouter;

final readonly class ApplicationFactory
{
    public function createApplication(): Kernel
    {
        return new Kernel(
            $this->createGetRequestRouter(),
            $this->createPostRequestRouter(),
        );
    }

    private function createGetRequestRouter(): GetRequestRouter
    {
        return new GetRequestRouter;
    }

    private function createPostRequestRouter(): PostRequestRouter
    {
        return new PostRequestRouter;
    }
}
