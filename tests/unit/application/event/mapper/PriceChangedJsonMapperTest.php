<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\Price;
use example\caledonia\domain\PriceChangedEvent;
use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[TestDox('PriceChangedJsonMapper')]
#[CoversClass(PriceChangedJsonMapper::class)]
#[UsesClass(PriceChangedEvent::class)]
#[UsesClass(Price::class)]
#[UsesClass(Uuid::class)]
#[Small]
final class PriceChangedJsonMapperTest extends TestCase
{
    #[TestDox('Maps array to PriceChangedEvent')]
    public function testMapsArrayToPriceChangedEvent(): void
    {
        $eventId  = Uuid::from('a50d99ff-d5b0-4d9b-a13c-c757974e0457');
        $good     = Good::Bread;
        $oldPrice = Price::from(1);
        $newPrice = Price::from(2);

        $event = (new PriceChangedJsonMapper)->fromArray(
            [
                'event_id'  => $eventId->asString(),
                'good'      => $good->value,
                'old_price' => $oldPrice->asInt(),
                'new_price' => $newPrice->asInt(),
            ],
        );

        $this->assertSame($eventId->asString(), $event->id()->asString());
        $this->assertSame($good, $event->good());
        $this->assertObjectEquals($oldPrice, $event->old());
        $this->assertObjectEquals($newPrice, $event->new());
    }

    #[TestDox('Maps PriceChangedEvent to array')]
    public function testMapsPriceChangedEventToArray(): void
    {
        $good     = Good::Bread;
        $oldPrice = Price::from(1);
        $newPrice = Price::from(2);

        $this->assertSame(
            [
                'good'      => 'bread',
                'old_price' => 1,
                'new_price' => 2,
            ],
            (new PriceChangedJsonMapper)->toArray(
                new PriceChangedEvent(
                    Uuid::from('a50d99ff-d5b0-4d9b-a13c-c757974e0457'),
                    $good,
                    $oldPrice,
                    $newPrice,
                ),
            ),
        );
    }
}
