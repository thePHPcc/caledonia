<?php declare(strict_types=1);
namespace example\caledonia\application;

final readonly class CommandFactory
{
    use EventReading;
    use EventWriting;

    public function createPurchaseGoodCommandProcessor(): PurchaseGoodCommandProcessor
    {
        return new PurchaseGoodCommandProcessor(
            $this->createEventEmitter(),
            $this->createMarketEventSourcer(),
        );
    }

    public function createSellGoodCommandProcessor(): SellGoodCommandProcessor
    {
        return new SellGoodCommandProcessor(
            $this->createEventEmitter(),
            $this->createMarketEventSourcer(),
        );
    }
}
