<?php declare(strict_types=1);
namespace example\caledonia\application;

/**
 * @no-named-arguments
 */
interface MarketHtmlProjectionReader
{
    public function read(): string;
}
