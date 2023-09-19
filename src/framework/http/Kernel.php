<?php declare(strict_types=1);
namespace example\framework\http;

use function assert;

final readonly class Kernel
{
    private GetRequestRouter $getRequestRouter;
    private PostRequestRouter $postRequestRouter;

    public function __construct(GetRequestRouter $getRequestRouter, PostRequestRouter $postRequestRouter)
    {
        $this->getRequestRouter  = $getRequestRouter;
        $this->postRequestRouter = $postRequestRouter;
    }

    public function run(Request $request): Response
    {
        if ($request->isGetRequest()) {
            /** @psalm-suppress RedundantCondition */
            assert($request instanceof GetRequest);

            $query = $this->getRequestRouter->route($request);

            return $query->execute();
        }

        if ($request->isPostRequest()) {
            /** @psalm-suppress RedundantCondition */
            assert($request instanceof PostRequest);

            $command = $this->postRequestRouter->route($request);

            return $command->execute();
        }
    }
}
