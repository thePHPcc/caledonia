<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\GoodPurchasedEvent;
use example\caledonia\domain\GoodSoldEvent;
use example\caledonia\domain\Price;
use example\caledonia\domain\PriceChangedEvent;
use example\framework\event\EventDispatcher;
use example\framework\library\Uuid;
use example\framework\library\UuidGenerator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

#[TestDox('DispatchingEventEmitter')]
#[CoversClass(DispatchingEventEmitter::class)]
#[UsesClass(GoodPurchasedEvent::class)]
#[UsesClass(GoodSoldEvent::class)]
#[UsesClass(PriceChangedEvent::class)]
#[UsesClass(Price::class)]
#[UsesClass(Uuid::class)]
#[Small]
final class DispatchingEventEmitterTest extends TestCase
{
    private DispatchingEventEmitter $emitter;
    private EventDispatcher&MockObject $dispatcher;
    private Stub&UuidGenerator $uuidGenerator;

    protected function setUp(): void
    {
        $this->uuidGenerator = $this->createStub(UuidGenerator::class);
        $this->dispatcher    = $this->createMock(EventDispatcher::class);

        $this->emitter = new DispatchingEventEmitter(
            $this->dispatcher,
            $this->uuidGenerator,
        );
    }

    #[TestDox('goodPurchased() emits GoodPurchased event')]
    public function testGoodPurchasedDispatchesGoodPurchasedEvent(): void
    {
        $uuid = Uuid::from('09925df9-0742-4980-aa70-16105a05a94f');

        $this
            ->uuidGenerator
            ->method('generate')
            ->willReturn($uuid);

        $good   = Good::Bread;
        $price  = Price::from(1);
        $amount = 2;

        $this
            ->dispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                new GoodPurchasedEvent(
                    $uuid,
                    $good,
                    $price,
                    $amount,
                ),
            );

        $this->emitter->goodPurchased($good, $price, $amount);
    }

    #[TestDox('goodSold() emits GoodSold event')]
    public function testGoodSoldDispatchesGoodSoldEvent(): void
    {
        $uuid = Uuid::from('6a19963d-de6f-47b4-8a66-95e3c54308d9');

        $this
            ->uuidGenerator
            ->method('generate')
            ->willReturn($uuid);

        $good   = Good::Bread;
        $price  = Price::from(1);
        $amount = 2;

        $this
            ->dispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                new GoodSoldEvent(
                    $uuid,
                    $good,
                    $price,
                    $amount,
                ),
            );

        $this->emitter->goodSold($good, $price, $amount);
    }

    #[TestDox('priceChanged() emits PriceChanged event')]
    public function testPriceChangedDispatchesPriceChangedEvent(): void
    {
        $uuid = Uuid::from('d32e54d2-3d68-4296-b28f-8e827cc42142');

        $this
            ->uuidGenerator
            ->method('generate')
            ->willReturn($uuid);

        $good     = Good::Bread;
        $oldPrice = Price::from(1);
        $newPrice = Price::from(2);

        $this
            ->dispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                new PriceChangedEvent(
                    $uuid,
                    $good,
                    $oldPrice,
                    $newPrice,
                ),
            );

        $this->emitter->priceChanged($good, $oldPrice, $newPrice);
    }
}
