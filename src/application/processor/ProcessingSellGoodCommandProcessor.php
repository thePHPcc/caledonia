<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\SellGoodCommand;

/**
 * @no-named-arguments
 */
final readonly class ProcessingSellGoodCommandProcessor implements SellGoodCommandProcessor
{
    private EventEmitter $emitter;
    private MarketSourcer $sourcer;

    public function __construct(EventEmitter $emitter, MarketSourcer $sourcer)
    {
        $this->emitter = $emitter;
        $this->sourcer = $sourcer;
    }

    public function process(SellGoodCommand $command): void
    {
        $market = $this->sourcer->source();

        $oldPrice = $market->priceFor($command->good());

        $market = $market->sell($command->good(), $command->amount());

        $this->emitter->goodSold($command->good(), $oldPrice, $command->amount());

        $newPrice = $market->priceFor($command->good());

        if (!$newPrice->equals($oldPrice)) {
            $this->emitter->priceChanged($command->good(), $oldPrice, $newPrice);
        }
    }
}
