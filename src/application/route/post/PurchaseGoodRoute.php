<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\PurchaseGoodCommand as DomainCommand;
use example\framework\http\PostRequest;
use example\framework\http\PostRequestRoute;

/**
 * @no-named-arguments
 */
final readonly class PurchaseGoodRoute extends AbstractTradeGoodRoute implements PostRequestRoute
{
    private CommandFactory $factory;

    public function __construct(CommandFactory $factory)
    {
        $this->factory = $factory;
    }

    public function route(PostRequest $request): false|PurchaseGoodCommand
    {
        if ($request->uri() !== '/purchase-good') {
            return false;
        }

        $data = $this->decode($request->body());

        return new PurchaseGoodCommand(
            $this->factory->createPurchaseGoodCommandProcessor(),
            new DomainCommand(
                $data['good'],
                $data['amount'],
            ),
        );
    }
}
