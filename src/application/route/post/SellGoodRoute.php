<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\SellGoodCommand as DomainCommand;
use example\framework\http\PostRequest;
use example\framework\http\PostRequestRoute;

/**
 * @no-named-arguments
 */
final readonly class SellGoodRoute extends AbstractTradeGoodRoute implements PostRequestRoute
{
    private CommandFactory $factory;

    public function __construct(CommandFactory $factory)
    {
        $this->factory = $factory;
    }

    public function route(PostRequest $request): false|SellGoodCommand
    {
        if ($request->uri() !== '/sell-good') {
            return false;
        }

        $data = $this->decode($request->body());

        return new SellGoodCommand(
            $this->factory->createSellGoodCommandProcessor(),
            new DomainCommand(
                $data['good'],
                $data['amount'],
            ),
        );
    }
}
