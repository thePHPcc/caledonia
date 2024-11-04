<?php declare(strict_types=1);
namespace example\caledonia\application;

/**
 * @no-named-arguments
 */
final readonly class ProductionCommandFactory implements CommandFactory
{
    use EventReading;
    use EventWriting;

    public function createPurchaseGoodCommandProcessor(): PurchaseGoodCommandProcessor
    {
        return new ProcessingPurchaseGoodCommandProcessor(
            $this->createEventEmitter(),
            $this->createMarketEventSourcer(),
        );
    }

    public function createSellGoodCommandProcessor(): SellGoodCommandProcessor
    {
        return new ProcessingSellGoodCommandProcessor(
            $this->createEventEmitter(),
            $this->createMarketEventSourcer(),
        );
    }
}
