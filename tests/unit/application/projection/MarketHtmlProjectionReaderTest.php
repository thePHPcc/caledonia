<?php declare(strict_types=1);
namespace example\caledonia\application;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(MarketHtmlProjectionReader::class)]
#[Group('domain')]
#[Small]
final class MarketHtmlProjectionReaderTest extends TestCase
{
    public function testReadsHtmlProjectionOfMarket(): void
    {
        $this->assertStringEqualsFile(
            __DIR__ . '/../../../../projections/market.html',
            (new MarketHtmlProjectionReader)->read(),
        );
    }
}
