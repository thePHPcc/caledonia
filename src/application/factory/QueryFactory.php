<?php declare(strict_types=1);
namespace example\caledonia\application;

/**
 * @no-named-arguments
 */
final readonly class QueryFactory
{
    use EventReading;

    public function createMarketHtmlProjectionReader(): MarketHtmlProjectionReader
    {
        return new MarketHtmlProjectionReader;
    }
}
