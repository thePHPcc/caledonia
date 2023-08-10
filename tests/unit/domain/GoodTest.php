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
        $good = Good::bread();

        $this->assertTrue($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame('bread', $good->asString());
    }

    public function testCanBeCheese(): void
    {
        $good = Good::cheese();

        $this->assertFalse($good->isBread());
        $this->assertTrue($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame('cheese', $good->asString());
    }

    public function testCanBeGrain(): void
    {
        $good = Good::grain();

        $this->assertFalse($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertTrue($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame('grain', $good->asString());
    }

    public function testCanBeMilk(): void
    {
        $good = Good::milk();

        $this->assertFalse($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertTrue($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame('milk', $good->asString());
    }

    public function testCanBeWhisky(): void
    {
        $good = Good::whisky();

        $this->assertFalse($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertTrue($good->isWhisky());
        $this->assertFalse($good->isWool());

        $this->assertSame('whisky', $good->asString());
    }

    public function testCanBeWool(): void
    {
        $good = Good::wool();

        $this->assertFalse($good->isBread());
        $this->assertFalse($good->isCheese());
        $this->assertFalse($good->isGrain());
        $this->assertFalse($good->isMilk());
        $this->assertFalse($good->isWhisky());
        $this->assertTrue($good->isWool());

        $this->assertSame('wool', $good->asString());
    }

    public function testCanBeCreatedFromString(): void
    {
        $this->assertTrue(Good::fromString('bread')->isBread());
        $this->assertTrue(Good::fromString('cheese')->isCheese());
        $this->assertTrue(Good::fromString('grain')->isGrain());
        $this->assertTrue(Good::fromString('milk')->isMilk());
        $this->assertTrue(Good::fromString('whisky')->isWhisky());
        $this->assertTrue(Good::fromString('wool')->isWool());
    }

    public function testIsComparable(): void
    {
        $this->assertTrue(Good::bread()->equals(Good::bread()));
        $this->assertFalse(Good::milk()->equals(Good::whisky()));
    }
}
