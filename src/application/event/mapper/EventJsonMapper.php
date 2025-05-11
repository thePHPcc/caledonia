<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\event\EventJsonMapper as FrameworkEventJsonMapper;

/**
 * @no-named-arguments
 *
 * @codeCoverageIgnore
 */
trait EventJsonMapper
{
    private function createEventJsonMapper(): FrameworkEventJsonMapper
    {
        return new FrameworkEventJsonMapper(
            [
                'market.good-purchased' => new GoodPurchasedJsonMapper,
                'market.good-sold'      => new GoodSoldJsonMapper,
                'market.price-changed'  => new PriceChangedJsonMapper,
            ],
        );
    }
}
