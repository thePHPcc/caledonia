<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Market;
use example\caledonia\domain\Price;
use example\caledonia\domain\PriceTable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MarketHtmlProjector::class)]
#[UsesClass(Market::class)]
#[UsesClass(PriceTable::class)]
#[UsesClass(Price::class)]
#[Group('domain')]
#[Small]
final class MarketHtmlProjectorTest extends TestCase
{
    public function testProjectsMarketAsHtml(): void
    {
        $projector = new MarketHtmlProjector;

        $this->assertStringEqualsFile(
            __DIR__ . '/../../../expectation/market.html',
            $projector->project(Market::create()),
        );
    }
}
