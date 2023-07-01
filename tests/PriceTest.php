<?php declare(strict_types=1);
namespace example\caledonia;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(Price::class)]
#[Small]
final class PriceTest extends TestCase
{
    public function testMustBePositive(): void
    {
        $this->expectException(PriceMustBePositiveException::class);

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
