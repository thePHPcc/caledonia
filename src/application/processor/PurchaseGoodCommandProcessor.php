<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\PurchaseGoodCommand;

/**
 * @no-named-arguments
 */
final readonly class PurchaseGoodCommandProcessor
{
    private EventEmitter $emitter;
    private MarketSourcer $sourcer;

    public function __construct(EventEmitter $emitter, MarketSourcer $sourcer)
    {
        $this->emitter = $emitter;
        $this->sourcer = $sourcer;
    }

    public function process(PurchaseGoodCommand $command): void
    {
        $market = $this->sourcer->source();

        $oldPrice = $market->priceFor($command->good());

        $market = $market->purchase($command->good(), $command->amount());

        $this->emitter->goodPurchased($command->good(), $oldPrice, $command->amount());

        $newPrice = $market->priceFor($command->good());

        if (!$newPrice->equals($oldPrice)) {
            $this->emitter->priceChanged($command->good(), $oldPrice, $newPrice);
        }
    }
}
