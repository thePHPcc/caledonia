<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Market::class)]
#[CoversClass(PriceTable::class)]
#[UsesClass(Good::class)]
#[UsesClass(Price::class)]
#[Group('domain')]
#[Small]
final class MarketTest extends TestCase
{
    public function testBreadHasInitialPriceOf10(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(10), $market->priceFor(Good::Bread));
    }

    public function testBreadCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Bread));

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::Bread));

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::Bread));

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::Bread));

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::Bread));

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::Bread));

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::Bread));

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::Bread));

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::Bread));

        $market = $market->purchase(Good::Bread, 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::Bread));
    }

    public function testBreadCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::Bread));

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::Bread));

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::Bread));

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::Bread));

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::Bread));

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::Bread));

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::Bread));

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Bread));

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Bread));

        $market = $market->sell(Good::Bread, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Bread));
    }

    public function testCheeseHasInitialPriceOf10(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(10), $market->priceFor(Good::Cheese));
    }

    public function testCheeseCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Cheese));

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::Cheese));

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::Cheese));

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::Cheese));

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::Cheese));

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::Cheese));

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::Cheese));

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::Cheese));

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::Cheese));

        $market = $market->purchase(Good::Cheese, 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::Cheese));
    }

    public function testCheeseCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::Cheese));

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::Cheese));

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::Cheese));

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::Cheese));

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::Cheese));

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::Cheese));

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::Cheese));

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Cheese));

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Cheese));

        $market = $market->sell(Good::Cheese, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Cheese));
    }

    public function testGrainHasInitialPriceOf5(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(5), $market->priceFor(Good::Grain));
    }

    public function testGrainCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Grain));

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::Grain));

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Grain));

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Grain));

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Grain));

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Grain));

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Grain));

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Grain));

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Grain));

        $market = $market->purchase(Good::Grain, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Grain));
    }

    public function testGrainCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Grain));

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Grain));

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Grain));

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Grain));

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Grain));

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Grain));

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::Grain));

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Grain));

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Grain));

        $market = $market->sell(Good::Grain, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Grain));
    }

    public function testMilkHasInitialPriceOf5(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(5), $market->priceFor(Good::Milk));
    }

    public function testMilkCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::Milk));

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Milk));

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Milk));

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Milk));

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Milk));

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Milk));

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Milk));

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Milk));

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Milk));

        $market = $market->purchase(Good::Milk, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Milk));
    }

    public function testMilkCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Milk));

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Milk));

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Milk));

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Milk));

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Milk));

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Milk));

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Milk));

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::Milk));

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Milk));

        $market = $market->sell(Good::Milk, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Milk));
    }

    public function testWhiskyHasInitialPriceOf11(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(11), $market->priceFor(Good::Whisky));
    }

    public function testWhiskyCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::Whisky));

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::Whisky));

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::Whisky));

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::Whisky));

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::Whisky));

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::Whisky));

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::Whisky));

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::Whisky));

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(16), $market->priceFor(Good::Whisky));

        $market = $market->purchase(Good::Whisky, 1);
        $this->assertEquals(Price::from(16), $market->priceFor(Good::Whisky));
    }

    public function testWhiskyCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(15), $market->priceFor(Good::Whisky));

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(14), $market->priceFor(Good::Whisky));

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::Whisky));

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(13), $market->priceFor(Good::Whisky));

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(12), $market->priceFor(Good::Whisky));

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(11), $market->priceFor(Good::Whisky));

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(10), $market->priceFor(Good::Whisky));

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(9), $market->priceFor(Good::Whisky));

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Whisky));

        $market = $market->sell(Good::Whisky, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Whisky));
    }

    public function testWoolHasInitialPriceOf4(): void
    {
        $market = Market::create();

        $this->assertObjectEquals(Price::from(4), $market->priceFor(Good::Wool));
    }

    public function testWoolCanBePurchased(): void
    {
        $market = Market::from(0, 0, 0, 0, 0, 0);

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Wool));

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::Wool));

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::Wool));

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Wool));

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Wool));

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Wool));

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Wool));

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Wool));

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Wool));

        $market = $market->purchase(Good::Wool, 1);
        $this->assertEquals(Price::from(8), $market->priceFor(Good::Wool));
    }

    public function testWoolCanBeSold(): void
    {
        $market = Market::from(9, 9, 9, 9, 9, 9);

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(7), $market->priceFor(Good::Wool));

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Wool));

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(6), $market->priceFor(Good::Wool));

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Wool));

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(5), $market->priceFor(Good::Wool));

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::Wool));

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(4), $market->priceFor(Good::Wool));

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Wool));

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Wool));

        $market = $market->sell(Good::Wool, 1);
        $this->assertEquals(Price::from(3), $market->priceFor(Good::Wool));
    }

    public function testHasPriceTableForEachGood(): void
    {
        $priceTables = Market::create()->priceTables();

        $this->assertCount(6, $priceTables);
        $this->assertArrayHasKey('bread', $priceTables);
        $this->assertArrayHasKey('cheese', $priceTables);
        $this->assertArrayHasKey('grain', $priceTables);
        $this->assertArrayHasKey('milk', $priceTables);
        $this->assertArrayHasKey('whisky', $priceTables);
        $this->assertArrayHasKey('wool', $priceTables);
    }
}
