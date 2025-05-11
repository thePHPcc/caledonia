<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\Market;
use example\caledonia\domain\Price;
use example\caledonia\domain\PriceTable;
use example\caledonia\domain\SellGoodCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ProcessingSellGoodCommandProcessor::class)]
#[UsesClass(SellGoodCommand::class)]
#[UsesClass(Good::class)]
#[UsesClass(Market::class)]
#[UsesClass(Price::class)]
#[UsesClass(PriceTable::class)]
#[Small]
final class ProcessingSellGoodCommandProcessorTest extends TestCase
{
    #[TestDox('Only a GoodSoldEvent is emitted when the price does not change')]
    public function testEmitsGoodSoldEvent(): void
    {
        $sourcer = $this->createStub(MarketSourcer::class);

        $sourcer
            ->method('source')
            ->willReturn(Market::from(5, 3, 3, 3, 3, 3));

        $emitter = $this->createMock(EventEmitter::class);

        $emitter
            ->expects($this->once())
            ->method('goodSold')
            ->with(Good::Bread, Price::from(11), 1);

        $emitter
            ->expects($this->never())
            ->method('goodPurchased');

        $emitter
            ->expects($this->never())
            ->method('priceChanged');

        $processor = new ProcessingSellGoodCommandProcessor($emitter, $sourcer);

        $processor->process(new SellGoodCommand(Good::Bread, 1));
    }

    #[TestDox('A GoodSoldEvent and a PriceChangedEvent are emitted when the price changes')]
    public function testEmitsGoodSoldAndPriceChangedEvents(): void
    {
        $sourcer = $this->createStub(MarketSourcer::class);

        $sourcer
            ->method('source')
            ->willReturn(Market::from(4, 3, 3, 3, 3, 3));

        $emitter = $this->createMock(EventEmitter::class);

        $emitter
            ->expects($this->once())
            ->method('goodSold')
            ->with(Good::Bread, Price::from(11), 3);

        $emitter
            ->expects($this->never())
            ->method('goodPurchased');

        $emitter
            ->expects($this->once())
            ->method('priceChanged')
            ->with(Good::Bread, Price::from(11), Price::from(8));

        $processor = new ProcessingSellGoodCommandProcessor($emitter, $sourcer);

        $processor->process(new SellGoodCommand(Good::Bread, 3));
    }
}
