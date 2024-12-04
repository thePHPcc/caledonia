<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
use function in_array;
use function is_array;
use function is_int;
use function json_decode;
use example\caledonia\domain\Good;
use example\caledonia\domain\PurchaseGoodCommand as DomainCommand;
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

    public function route(PostRequest $request): false|PurchaseGoodCommand
    {
        if ($request->uri() !== '/purchase-good') {
            return false;
        }

        $data = json_decode($request->body(), true);

        assert(is_array($data));
        assert(isset($data['good']) && in_array($data['good'], ['bread', 'cheese', 'grain', 'milk', 'whisky', 'wool'], true));
        assert(isset($data['amount']) && is_int($data['amount']));

        $good   = Good::from($data['good']);
        $amount = $data['amount'];

        assert($amount >= 1);

        return new PurchaseGoodCommand(
            $this->factory->createPurchaseGoodCommandProcessor(),
            new DomainCommand(
                $good,
                $amount,
            ),
        );
    }
}
