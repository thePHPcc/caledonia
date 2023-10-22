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
        return new GetRequestRouter(
            new MarketRoute($this->createQueryFactory()),
            new NotFoundGetRoute,
        );
    }

    private function createPostRequestRouter(): PostRequestRouter
    {
        return new PostRequestRouter(
            new PurchaseGoodRoute($this->createCommandFactory()),
            new SellGoodRoute($this->createCommandFactory()),
            new NotFoundPostRoute,
        );
    }

    private function createCommandFactory(): CommandFactory
    {
        return new CommandFactory;
    }

    private function createQueryFactory(): QueryFactory
    {
        return new QueryFactory;
    }
}
