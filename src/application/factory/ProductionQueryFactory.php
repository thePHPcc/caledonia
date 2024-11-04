<?php declare(strict_types=1);
namespace example\caledonia\application;

/**
 * @no-named-arguments
 */
final readonly class ProductionQueryFactory implements QueryFactory
{
    use EventReading;

    public function createMarketHtmlProjectionReader(): MarketHtmlProjectionReader
    {
        return new FilesystemMarketHtmlProjectionReader(__DIR__ . '/../../../projections/market.html');
    }
}
