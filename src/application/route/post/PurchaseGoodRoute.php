<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
use function is_array;
use function json_decode;
use example\caledonia\domain\Good;
use example\caledonia\domain\PurchaseGoodCommand;
use example\framework\http\PostRequest;
use example\framework\http\PostRequestRoute;

/**
 * @no-named-arguments
 */
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

        assert(is_array($data));
        assert(isset($data['good']));
        assert(isset($data['amount']));

        $good   = Good::fromString($data['good']);
        $amount = (int) $data['amount'];

        assert($amount >= 1);

        return new PurchaseCommand(
            $this->factory->createPurchaseGoodCommandProcessor(),
            new PurchaseGoodCommand(
                $good,
                $amount,
            ),
        );
    }
}
