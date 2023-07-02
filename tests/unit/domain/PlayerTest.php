<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Player::class)]
#[UsesClass(Money::class)]
#[Small]
final class PlayerTest extends TestCase
{
    public function testHasName(): void
    {
        $this->assertSame('the-name', $this->player()->name());
    }

    public function testNameMustNotBeEmpty(): void
    {
        $this->expectException(NameMustNotBeEmptyException::class);

        Player::from('', Money::from(50), 1, 2, 3, 4, 5, 6);
    }

    public function testHasBalance(): void
    {
        $this->assertObjectEquals(Money::from(50), $this->player()->balance());
    }

    public function testHasBread(): void
    {
        $this->assertSame(1, $this->player()->bread());
    }

    public function testHasCheese(): void
    {
        $this->assertSame(2, $this->player()->cheese());
    }

    public function testHasGrain(): void
    {
        $this->assertSame(3, $this->player()->grain());
    }

    public function testHasMilk(): void
    {
        $this->assertSame(4, $this->player()->milk());
    }

    public function testHasWhisky(): void
    {
        $this->assertSame(5, $this->player()->whisky());
    }

    public function testHasWool(): void
    {
        $this->assertSame(6, $this->player()->wool());
    }

    private function player(): Player
    {
        return Player::from('the-name', Money::from(50), 1, 2, 3, 4, 5, 6);
    }
}
