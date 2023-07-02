<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Market::class)]
#[CoversClass(PriceTable::class)]
#[UsesClass(Good::class)]
#[UsesClass(Bread::class)]
#[UsesClass(Cheese::class)]
#[UsesClass(Grain::class)]
#[UsesClass(Milk::class)]
#[UsesClass(Whisky::class)]
#[UsesClass(Wool::class)]
#[UsesClass(Price::class)]
#[Small]
final class MarketTest extends TestCase
{
    public function testBreadHasInitialPriceOf10(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(10), $market->priceFor(Good::bread()));
    }

    public function testBreadCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::bread()));

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::bread()));

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::bread()));

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::bread()));

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::bread()));

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::bread()));

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::bread()));

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::bread()));

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::bread()));

        $market->purchase(Good::bread(), 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::bread()));
    }

    public function testBreadCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::bread()));

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::bread()));

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::bread()));

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::bread()));

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::bread()));

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::bread()));

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::bread()));

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::bread()));

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::bread()));

        $market->sell(Good::bread(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::bread()));
    }

    public function testCheeseHasInitialPriceOf10(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(10), $market->priceFor(Good::cheese()));
    }

    public function testCheeseCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::cheese()));

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::cheese()));

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::cheese()));

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::cheese()));

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::cheese()));

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::cheese()));

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::cheese()));

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::cheese()));

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::cheese()));

        $market->purchase(Good::cheese(), 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::cheese()));
    }

    public function testCheeseCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::cheese()));

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::cheese()));

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::cheese()));

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::cheese()));

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::cheese()));

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::cheese()));

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::cheese()));

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::cheese()));

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::cheese()));

        $market->sell(Good::cheese(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::cheese()));
    }

    public function testGrainHasInitialPriceOf5(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(5), $market->priceFor(Good::grain()));
    }

    public function testGrainCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::grain()));

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::grain()));

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::grain()));

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::grain()));

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::grain()));

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::grain()));

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::grain()));

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::grain()));

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::grain()));

        $market->purchase(Good::grain(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::grain()));
    }

    public function testGrainCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::grain()));

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::grain()));

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::grain()));

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::grain()));

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::grain()));

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::grain()));

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::grain()));

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::grain()));

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::grain()));

        $market->sell(Good::grain(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::grain()));
    }

    public function testMilkHasInitialPriceOf5(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(5), $market->priceFor(Good::milk()));
    }

    public function testMilkCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::milk()));

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::milk()));

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::milk()));

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::milk()));

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::milk()));

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::milk()));

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::milk()));

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::milk()));

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::milk()));

        $market->purchase(Good::milk(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::milk()));
    }

    public function testMilkCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::milk()));

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::milk()));

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::milk()));

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::milk()));

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::milk()));

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::milk()));

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::milk()));

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::milk()));

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::milk()));

        $market->sell(Good::milk(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::milk()));
    }

    public function testWhiskyHasInitialPriceOf11(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(11), $market->priceFor(Good::whisky()));
    }

    public function testWhiskyCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::whisky()));

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::whisky()));

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::whisky()));

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::whisky()));

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::whisky()));

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::whisky()));

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::whisky()));

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::whisky()));

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(16), $market->priceFor(Good::whisky()));

        $market->purchase(Good::whisky(), 1);
        $this->assertEquals(Price::from(16), $market->priceFor(Good::whisky()));
    }

    public function testWhsikyCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::whisky()));

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::whisky()));

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::whisky()));

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::whisky()));

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::whisky()));

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::whisky()));

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::whisky()));

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::whisky()));

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::whisky()));

        $market->sell(Good::whisky(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::whisky()));
    }

    public function testWoolHasInitialPriceOf4(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(4), $market->priceFor(Good::wool()));
    }

    public function testWoolCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::wool()));

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::wool()));

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::wool()));

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::wool()));

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::wool()));

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::wool()));

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::wool()));

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::wool()));

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::wool()));

        $market->purchase(Good::wool(), 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::wool()));
    }

    public function testWoolCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::wool()));

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::wool()));

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::wool()));

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::wool()));

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::wool()));

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::wool()));

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::wool()));

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::wool()));

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::wool()));

        $market->sell(Good::wool(), 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::wool()));
    }
}
