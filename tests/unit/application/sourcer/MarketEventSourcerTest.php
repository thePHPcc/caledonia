<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\GoodPurchasedEvent;
use example\caledonia\domain\GoodSoldEvent;
use example\caledonia\domain\Market;
use example\caledonia\domain\Price;
use example\caledonia\domain\PriceChangedEvent;
use example\caledonia\domain\PriceTable;
use example\framework\event\Event;
use example\framework\event\EventCollection;
use example\framework\event\EventCollectionIterator;
use example\framework\event\EventReader;
use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MarketEventSourcer::class)]
#[UsesClass(GoodPurchasedEvent::class)]
#[UsesClass(GoodSoldEvent::class)]
#[UsesClass(Market::class)]
#[UsesClass(Price::class)]
#[UsesClass(PriceChangedEvent::class)]
#[UsesClass(PriceTable::class)]
#[UsesClass(Event::class)]
#[UsesClass(EventCollection::class)]
#[UsesClass(EventCollectionIterator::class)]
#[UsesClass(Uuid::class)]
#[Small]
final class MarketEventSourcerTest extends TestCase
{
    public function testSourcesMarketFromEvents(): void
    {
        $reader = $this->createStub(EventReader::class);

        $reader
            ->method('topic')
            ->willReturn(
                EventCollection::fromArray(
                    [
                        new GoodPurchasedEvent(
                            Uuid::from('ec055374-1c5e-4d37-a66e-8f3676cdd34a'),
                            Good::Milk,
                            Price::from(5),
                            3,
                        ),
                        new GoodSoldEvent(
                            Uuid::from('bbb77d03-60aa-4206-9329-22fe61fd1097'),
                            Good::Bread,
                            Price::from(10),
                            2,
                        ),
                    ],
                ),
            );

        $sourcer = new MarketEventSourcer($reader);

        $market = $sourcer->source();

        $this->assertSame(4, $market->priceFor(Good::Wool)->asInt());
        $this->assertSame(5, $market->priceFor(Good::Grain)->asInt());
        $this->assertSame(7, $market->priceFor(Good::Milk)->asInt());
        $this->assertSame(8, $market->priceFor(Good::Bread)->asInt());
        $this->assertSame(10, $market->priceFor(Good::Cheese)->asInt());
        $this->assertSame(11, $market->priceFor(Good::Whisky)->asInt());
    }
}
