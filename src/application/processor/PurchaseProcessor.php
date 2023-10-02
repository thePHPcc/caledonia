<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;

final readonly class PurchaseProcessor
{
    private EventEmitter $emitter;
    private MarketSourcer $sourcer;

    public function __construct(EventEmitter $emitter, MarketSourcer $sourcer)
    {
        $this->emitter = $emitter;
        $this->sourcer = $sourcer;
    }

    public function process(Good $good, int $amount): void
    {
        $market = $this->sourcer->source();

        $oldPrice = $market->priceFor($good);

        $market = $market->purchase($good, $amount);

        $this->emitter->goodPurchased($good, $oldPrice, $amount);

        $newPrice = $market->priceFor($good);

        if (!$newPrice->equals($oldPrice)) {
            $this->emitter->priceChanged($good, $oldPrice, $newPrice);
        }
    }
}
