<?php declare(strict_types=1);
namespace example\caledonia;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Market::class)]
#[CoversClass(PriceTable::class)]
#[UsesClass(Good::class)]
#[UsesClass(Price::class)]
#[Small]
final class MarketTest extends TestCase
{
    public function testBreadHasInitialPriceOf10(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(10), $market->priceFor(Good::bread()));
    }

    public function testCheeseHasInitialPriceOf10(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(10), $market->priceFor(Good::cheese()));
    }

    public function testGrainHasInitialPriceOf5(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(5), $market->priceFor(Good::grain()));
    }

    public function testMilkHasInitialPriceOf5(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(5), $market->priceFor(Good::milk()));
    }

    public function testWhiskyHasInitialPriceOf11(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(11), $market->priceFor(Good::whisky()));
    }

    public function testWoolHasInitialPriceOf4(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(4), $market->priceFor(Good::wool()));
    }
}
