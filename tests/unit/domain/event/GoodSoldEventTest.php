<?php declare(strict_types=1);
namespace example\caledonia\domain;

use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(GoodSoldEvent::class)]
#[UsesClass(Price::class)]
#[UsesClass(Uuid::class)]
#[Group('domain')]
#[Small]
final class GoodSoldEventTest extends TestCase
{
    private const string UUID = '34bfb993-7044-4c1e-902b-f733ca4dded5';

    public function testHasId(): void
    {
        $this->assertSame(self::UUID, $this->event()->id()->asString());
    }

    public function testHasTopic(): void
    {
        $this->assertSame('market.good-sold', $this->event()->topic());
    }

    public function testHasGood(): void
    {
        $this->assertSame(Good::Bread, $this->event()->good());
    }

    public function testHasPrice(): void
    {
        $this->assertSame(1, $this->event()->price()->asInt());
    }

    public function testHasAmount(): void
    {
        $this->assertSame(1, $this->event()->amount());
    }

    public function testCanBeRepresentedAsString(): void
    {
        $this->assertSame('1 bread sold at price 1', $this->event()->asString());
    }

    private function event(): GoodSoldEvent
    {
        return new GoodSoldEvent(
            new Uuid(self::UUID),
            Good::Bread,
            Price::from(1),
            1,
        );
    }
}
