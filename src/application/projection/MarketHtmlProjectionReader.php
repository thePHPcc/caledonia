<?php declare(strict_types=1);
namespace example\caledonia\application;

use function file_get_contents;

final readonly class MarketHtmlProjectionReader
{
    public function read(): string
    {
        return file_get_contents(__DIR__ . '/../../../projections/market.html');
    }
}
