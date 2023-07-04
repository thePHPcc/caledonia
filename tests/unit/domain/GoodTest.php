<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(Good::class)]
#[CoversClass(Bread::class)]
#[CoversClass(Cheese::class)]
#[CoversClass(Grain::class)]
#[CoversClass(Milk::class)]
#[CoversClass(Whisky::class)]
#[CoversClass(Wool::class)]
#[Group('domain')]
#[Small]
final class GoodTest extends TestCase
{
    public function testCanBeBread(): void
    {
        $string = 'bread';

        $good = Good::fromString($string);

        $this->assertTrue($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame($string, $good->asString());
    }

    public function testCanBeCheese(): void
    {
        $string = 'cheese';

        $good = Good::fromString($string);

        $this->assertFalse($good->isBread());
        $this->assertTrue($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame($string, $good->asString());
    }

    public function testCanBeGrain(): void
    {
        $string = 'grain';

        $good = Good::fromString($string);

        $this->assertFalse($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertTrue($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame($string, $good->asString());
    }

    public function testCanBeMilk(): void
    {
        $string = 'milk';

        $good = Good::fromString($string);

        $this->assertFalse($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertTrue($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame($string, $good->asString());
    }

    public function testCanBeWhisky(): void
    {
        $string = 'whisky';

        $good = Good::fromString($string);

        $this->assertFalse($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertTrue($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame($string, $good->asString());
    }

    public function testCanBeWool(): void
    {
        $string = 'wool';

        $good = Good::fromString($string);

        $this->assertFalse($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertTrue($good->isWool());

        $this->assertSame($string, $good->asString());
    }

    public function testIsComparable(): void
    {
        $this->assertTrue(Good::bread()->equals(Good::bread()));
        $this->assertFalse(Good::milk()->equals(Good::whisky()));
    }
}
