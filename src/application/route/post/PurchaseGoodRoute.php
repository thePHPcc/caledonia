<?php declare(strict_types=1);
namespace example\caledonia\application;

use function json_decode;
use example\caledonia\domain\Good;
use example\caledonia\domain\PurchaseGoodCommand;
use example\framework\http\PostRequest;
use example\framework\http\PostRequestRoute;

final readonly class PurchaseGoodRoute implements PostRequestRoute
{
    private CommandFactory $factory;

    public function __construct(CommandFactory $factory)
    {
        $this->factory = $factory;
    }

    public function route(PostRequest $request): false|PurchaseCommand
    {
        if ($request->uri() !== '/purchase-good') {
            return false;
        }

        $data = json_decode($request->body(), true);

        return new PurchaseCommand(
            $this->factory->createPurchaseGoodCommandProcessor(),
            new PurchaseGoodCommand(
                Good::fromString($data['good']),
                (int) $data['amount'],
            ),
        );
    }
}
