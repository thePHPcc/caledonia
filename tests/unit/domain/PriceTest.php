<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(Price::class)]
#[Group('domain')]
#[Small]
final class PriceTest extends TestCase
{
    public function testMustBePositive(): void
    {
        $this->expectException(PriceMustBePositiveException::class);

        /** @phpstan-ignore argument.type */
        Price::from(0);
    }

    public function testCanBeRepresentedAsInteger(): void
    {
        $price = 1;

        $this->assertSame($price, Price::from($price)->asInt());
    }

    public function testIsComparable(): void
    {
        $this->assertTrue(Price::from(1)->equals(Price::from(1)));
        $this->assertFalse(Price::from(1)->equals(Price::from(2)));
    }
}
