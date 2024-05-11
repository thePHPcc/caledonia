<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
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

        $good   = Good::fromString($data['good']);
        $amount = (int) $data['amount'];

        assert($amount >= 1);

        return new SellCommand(
            $this->factory->createSellGoodCommandProcessor(),
            new SellGoodCommand(
                $good,
                $amount,
            ),
        );
    }
}
