<?php declare(strict_types=1);
namespace example\caledonia\application;

/**
 * @no-named-arguments
 */
interface QueryFactory
{
    public function createMarketHtmlProjectionReader(): MarketHtmlProjectionReader;
}
