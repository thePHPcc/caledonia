<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PriceTable::class)]
#[UsesClass(Price::class)]
#[Group('domain')]
#[Small]
final class PriceTableTest extends TestCase
{
    public function testCanBeCreatedForBread(): void
    {
        $priceTable = PriceTable::bread(0);

        $this->assertSame(7, $priceTable->at(0)->asInt());
        $this->assertSame(8, $priceTable->at(1)->asInt());
        $this->assertSame(9, $priceTable->at(2)->asInt());
        $this->assertSame(10, $priceTable->at(3)->asInt());
        $this->assertSame(11, $priceTable->at(4)->asInt());
        $this->assertSame(11, $priceTable->at(5)->asInt());
        $this->assertSame(12, $priceTable->at(6)->asInt());
        $this->assertSame(13, $priceTable->at(7)->asInt());
        $this->assertSame(14, $priceTable->at(8)->asInt());
        $this->assertSame(15, $priceTable->at(9)->asInt());
    }

    public function testCanBeCreatedForCheese(): void
    {
        $priceTable = PriceTable::cheese(0);

        $this->assertSame(7, $priceTable->at(0)->asInt());
        $this->assertSame(8, $priceTable->at(1)->asInt());
        $this->assertSame(9, $priceTable->at(2)->asInt());
        $this->assertSame(10, $priceTable->at(3)->asInt());
        $this->assertSame(11, $priceTable->at(4)->asInt());
        $this->assertSame(12, $priceTable->at(5)->asInt());
        $this->assertSame(13, $priceTable->at(6)->asInt());
        $this->assertSame(14, $priceTable->at(7)->asInt());
        $this->assertSame(14, $priceTable->at(8)->asInt());
        $this->assertSame(15, $priceTable->at(9)->asInt());
    }

    public function testCanBeCreatedForGrain(): void
    {
        $priceTable = PriceTable::grain(0);

        $this->assertSame(3, $priceTable->at(0)->asInt());
        $this->assertSame(3, $priceTable->at(1)->asInt());
        $this->assertSame(4, $priceTable->at(2)->asInt());
        $this->assertSame(5, $priceTable->at(3)->asInt());
        $this->assertSame(6, $priceTable->at(4)->asInt());
        $this->assertSame(6, $priceTable->at(5)->asInt());
        $this->assertSame(7, $priceTable->at(6)->asInt());
        $this->assertSame(7, $priceTable->at(7)->asInt());
        $this->assertSame(8, $priceTable->at(8)->asInt());
        $this->assertSame(8, $priceTable->at(9)->asInt());
    }

    public function testCanBeCreatedForMilk(): void
    {
        $priceTable = PriceTable::milk(0);

        $this->assertSame(3, $priceTable->at(0)->asInt());
        $this->assertSame(4, $priceTable->at(1)->asInt());
        $this->assertSame(5, $priceTable->at(2)->asInt());
        $this->assertSame(5, $priceTable->at(3)->asInt());
        $this->assertSame(6, $priceTable->at(4)->asInt());
        $this->assertSame(6, $priceTable->at(5)->asInt());
        $this->assertSame(7, $priceTable->at(6)->asInt());
        $this->assertSame(7, $priceTable->at(7)->asInt());
        $this->assertSame(8, $priceTable->at(8)->asInt());
        $this->assertSame(8, $priceTable->at(9)->asInt());
    }

    public function testCanBeCreatedForWhisky(): void
    {
        $priceTable = PriceTable::whisky(0);

        $this->assertSame(8, $priceTable->at(0)->asInt());
        $this->assertSame(9, $priceTable->at(1)->asInt());
        $this->assertSame(10, $priceTable->at(2)->asInt());
        $this->assertSame(11, $priceTable->at(3)->asInt());
        $this->assertSame(12, $priceTable->at(4)->asInt());
        $this->assertSame(13, $priceTable->at(5)->asInt());
        $this->assertSame(13, $priceTable->at(6)->asInt());
        $this->assertSame(14, $priceTable->at(7)->asInt());
        $this->assertSame(15, $priceTable->at(8)->asInt());
        $this->assertSame(16, $priceTable->at(9)->asInt());
    }

    public function testCanBeCreatedForWool(): void
    {
        $priceTable = PriceTable::wool(0);

        $this->assertSame(3, $priceTable->at(0)->asInt());
        $this->assertSame(3, $priceTable->at(1)->asInt());
        $this->assertSame(4, $priceTable->at(2)->asInt());
        $this->assertSame(4, $priceTable->at(3)->asInt());
        $this->assertSame(5, $priceTable->at(4)->asInt());
        $this->assertSame(5, $priceTable->at(5)->asInt());
        $this->assertSame(6, $priceTable->at(6)->asInt());
        $this->assertSame(6, $priceTable->at(7)->asInt());
        $this->assertSame(7, $priceTable->at(8)->asInt());
        $this->assertSame(8, $priceTable->at(9)->asInt());
    }

    public function testCurrentPositionCanBeQueried(): void
    {
        $priceTable = PriceTable::bread(0);

        $this->assertSame(0, $priceTable->currentPosition());
    }

    public function testPriceCanBeQueriedByPosition(): void
    {
        $priceTable = PriceTable::bread(0);

        $this->assertSame(7, $priceTable->at(0)->asInt());
    }

    public function testCurrentPriceCanBeQueried(): void
    {
        $priceTable = PriceTable::bread(0);

        $this->assertSame(7, $priceTable->current()->asInt());
    }

    public function testPriceCanBeIncreased(): void
    {
        $old = PriceTable::bread(0);
        $new = $old->increase();

        $this->assertNotSame($new, $old);
        $this->assertSame(1, $new->currentPosition());
    }

    public function testPriceCannotBeIncreasedAfterLastPosition(): void
    {
        $old = PriceTable::bread(9);
        $new = $old->increase();

        $this->assertNotSame($new, $old);
        $this->assertSame(9, $new->currentPosition());
    }

    public function testPriceCanBeDecreased(): void
    {
        $old = PriceTable::bread(1);
        $new = $old->decrease();

        $this->assertNotSame($new, $old);
        $this->assertSame(0, $new->currentPosition());
    }

    public function testPriceCannotBeDecreasedBeforeFirstPosition(): void
    {
        $old = PriceTable::bread(0);
        $new = $old->decrease();

        $this->assertNotSame($new, $old);
        $this->assertSame(0, $new->currentPosition());
    }
}
