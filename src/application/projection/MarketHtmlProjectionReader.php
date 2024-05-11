<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
use function file_get_contents;

final readonly class MarketHtmlProjectionReader
{
    public function read(): string
    {
        $buffer = file_get_contents(__DIR__ . '/../../../projections/market.html');

        assert($buffer !== false);

        return $buffer;
    }
}
