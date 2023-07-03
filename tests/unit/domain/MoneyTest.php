<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(Money::class)]
#[Group('domain')]
#[Small]
final class MoneyTest extends TestCase
{
    public function testCanBeRepresentedAsInteger(): void
    {
        $balance = 1;

        $this->assertSame($balance, Money::from($balance)->asInt());
    }

    public function testAnotherValueCanBeAdded(): void
    {
        $a = Money::from(1);
        $b = Money::from(2);

        $this->assertObjectEquals(Money::from(3), $a->plus($b));
    }

    public function testAnotherValueCanBeSubtracted(): void
    {
        $a = Money::from(2);
        $b = Money::from(1);

        $this->assertObjectEquals(Money::from(1), $a->minus($b));
    }

    public function testIsComparable(): void
    {
        $this->assertTrue(Money::from(1)->equals(Money::from(1)));
        $this->assertFalse(Money::from(1)->equals(Money::from(2)));
    }

    public function testCannotBeNegative(): void
    {
        $this->expectException(AmountMustNotBeNegativeException::class);

        Money::from(-1);
    }

    public function testCannotBecomeNegative(): void
    {
        $this->expectException(AmountMustNotBecomeNegativeException::class);

        Money::from(0)->minus(Money::from(1));
    }
}
