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
    }

    public function testIsComparable(): void
    {
        $this->assertTrue(Good::bread()->equals(Good::bread()));
        $this->assertFalse(Good::milk()->equals(Good::whisky()));
    }
}
