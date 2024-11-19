<?php declare(strict_types=1);
namespace example\framework\http;

/**
 * @no-named-arguments
 */
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
            $query = $this->getRequestRouter->route($request);

            return $query->execute();
        }

        if ($request->isPostRequest()) {
            $command = $this->postRequestRouter->route($request);

            return $command->execute();
        }

        throw new RequestCannotBeRoutedException;
    }
}
