<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
use example\caledonia\domain\GoodPurchasedEvent;
use example\caledonia\domain\GoodSoldEvent;
use example\caledonia\domain\Market;
use example\framework\event\EventReader;

final readonly class MarketEventSourcer implements MarketSourcer
{
    private EventReader $reader;

    public function __construct(EventReader $reader)
    {
        $this->reader = $reader;
    }

    public function source(): Market
    {
        $market = Market::create();

        foreach ($this->reader->topic(['market.good-purchased', 'market.good-sold']) as $event) {
            assert($event instanceof GoodPurchasedEvent || $event instanceof GoodSoldEvent);

            if ($event instanceof GoodPurchasedEvent) {
                $market = $market->purchase($event->good(), $event->amount());

                continue;
            }

            $market = $market->sell($event->good(), $event->amount());
        }

        return $market;
    }
}
