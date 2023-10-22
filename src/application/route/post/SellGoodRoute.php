<?php declare(strict_types=1);
namespace example\caledonia\application;

use function json_decode;
use example\caledonia\domain\Good;
use example\caledonia\domain\SellGoodCommand;
use example\framework\http\PostRequest;
use example\framework\http\PostRequestRoute;

final readonly class SellGoodRoute implements PostRequestRoute
{
    private CommandFactory $factory;

    public function __construct(CommandFactory $factory)
    {
        $this->factory = $factory;
    }

    public function route(PostRequest $request): false|SellCommand
    {
        if ($request->uri() !== '/sell-good') {
            return false;
        }

        $data = json_decode($request->body(), true);

        return new SellCommand(
            $this->factory->createSellGoodCommandProcessor(),
            new SellGoodCommand(
                Good::fromString($data['good']),
                (int) $data['amount'],
            ),
        );
    }
}
