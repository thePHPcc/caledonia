<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Bread;
use example\caledonia\domain\Good;
use example\caledonia\domain\Market;
use example\caledonia\domain\Price;
use example\caledonia\domain\PriceTable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PurchaseProcessor::class)]
#[UsesClass(Bread::class)]
#[UsesClass(Good::class)]
#[UsesClass(Market::class)]
#[UsesClass(Price::class)]
#[UsesClass(PriceTable::class)]
#[Group('domain')]
#[Small]
final class PurchaseGoodProcessorTest extends TestCase
{
    #[TestDox('Only a GoodPurchasedEvent is emitted when the price does not change')]
    public function testEmitsGoodPurchasedEvent(): void
    {
        $sourcer = $this->createStub(MarketSourcer::class);

        $sourcer
            ->method('source')
            ->willReturn(Market::from(4, 3, 3, 3, 3, 3));

        $emitter = $this->createMock(EventEmitter::class);

        $emitter
            ->expects($this->once())
            ->method('goodPurchased')
            ->with(Good::bread(), Price::from(11), 1);

        $emitter
            ->expects($this->never())
            ->method('goodSold');

        $emitter
            ->expects($this->never())
            ->method('priceChanged');

        $processor = new PurchaseProcessor($emitter, $sourcer);

        $processor->process(Good::bread(), 1);
    }

    #[TestDox('A GoodPurchasedEvent and a PriceChangedEvent are emitted when the price changes')]
    public function testEmitsGoodPurchasedAndPriceChangedEvents(): void
    {
        $sourcer = $this->createStub(MarketSourcer::class);

        $sourcer
            ->method('source')
            ->willReturn(Market::create());

        $emitter = $this->createMock(EventEmitter::class);

        $emitter
            ->expects($this->once())
            ->method('goodPurchased')
            ->with(Good::bread(), Price::from(10), 3);

        $emitter
            ->expects($this->never())
            ->method('goodSold');

        $emitter
            ->expects($this->once())
            ->method('priceChanged')
            ->with(Good::bread(), Price::from(10), Price::from(12));

        $processor = new PurchaseProcessor($emitter, $sourcer);

        $processor->process(Good::bread(), 3);
    }
}
