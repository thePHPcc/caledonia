<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\http\GetRequest;
use example\framework\http\GetRequestRoute;
use example\framework\http\Query;

/**
 * @no-named-arguments
 */
final readonly class MarketRoute implements GetRequestRoute
{
    private QueryFactory $factory;

    public function __construct(QueryFactory $factory)
    {
        $this->factory = $factory;
    }

    public function route(GetRequest $request): false|Query
    {
        if ($request->uri() !== '/market') {
            return false;
        }

        return new MarketQuery($this->factory->createMarketHtmlProjectionReader());
    }
}
