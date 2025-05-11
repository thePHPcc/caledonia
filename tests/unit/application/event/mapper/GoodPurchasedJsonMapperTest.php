<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\GoodPurchasedEvent;
use example\caledonia\domain\Price;
use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[TestDox('GoodPurchasedJsonMapper')]
#[CoversClass(GoodPurchasedJsonMapper::class)]
#[UsesClass(GoodPurchasedEvent::class)]
#[UsesClass(Price::class)]
#[UsesClass(Uuid::class)]
#[Small]
final class GoodPurchasedJsonMapperTest extends TestCase
{
    #[TestDox('Maps array to GoodPurchasedEvent')]
    public function testMapsArrayToGoodPurchasedEvent(): void
    {
        $eventId = Uuid::from('792ef75b-f6c4-4a89-83c2-6e24ce8a13e7');
        $good    = Good::Bread;
        $price   = Price::from(1);
        $amount  = 2;

        $event = (new GoodPurchasedJsonMapper)->fromArray(
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

    #[TestDox('Maps GoodPurchasedEvent to array')]
    public function testMapsGoodPurchasedEventToArray(): void
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
            (new GoodPurchasedJsonMapper)->toArray(
                new GoodPurchasedEvent(
                    Uuid::from('792ef75b-f6c4-4a89-83c2-6e24ce8a13e7'),
                    $good,
                    $price,
                    $amount,
                ),
            ),
        );
    }
}
