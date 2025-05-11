<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\GoodSoldEvent;
use example\caledonia\domain\Price;
use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[TestDox('GoodSoldJsonMapper')]
#[CoversClass(GoodSoldJsonMapper::class)]
#[UsesClass(GoodSoldEvent::class)]
#[UsesClass(Price::class)]
#[UsesClass(Uuid::class)]
#[Small]
final class GoodSoldJsonMapperTest extends TestCase
{
    #[TestDox('Maps array to GoodSoldEvent')]
    public function testMapsArrayToGoodSoldEvent(): void
    {
        $eventId = Uuid::from('a50d99ff-d5b0-4d9b-a13c-c757974e0457');
        $good    = Good::Bread;
        $price   = Price::from(1);
        $amount  = 2;

        $event = (new GoodSoldJsonMapper)->fromArray(
            [
                'event_id' => $eventId->asString(),
                'good'     => $good->value,
                'price'    => $price->asInt(),
                'amount'   => $amount,
            ],
        );

        $this->assertSame($eventId->asString(), $event->id()->asString());
        $this->assertSame($good, $event->good());
        $this->assertObjectEquals($price, $event->price());
        $this->assertSame($amount, $event->amount());
    }

    #[TestDox('Maps GoodSoldEvent to array')]
    public function testMapsGoodSoldEventToArray(): void
    {
        $good   = Good::Bread;
        $price  = Price::from(1);
        $amount = 2;

        $this->assertSame(
            [
                'good'   => 'bread',
                'price'  => 1,
                'amount' => 2,
            ],
            (new GoodSoldJsonMapper)->toArray(
                new GoodSoldEvent(
                    Uuid::from('a50d99ff-d5b0-4d9b-a13c-c757974e0457'),
                    $good,
                    $price,
                    $amount,
                ),
            ),
        );
    }
}
