<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
use example\caledonia\domain\Good;
use example\caledonia\domain\GoodPurchasedEvent;
use example\caledonia\domain\Price;
use example\framework\event\Event;
use example\framework\event\EventArrayMapper;
use example\framework\library\Uuid;

final class GoodPurchasedJsonMapper implements EventArrayMapper
{
    /**
     * @param array{event_id: string, good: 'bread'|'cheese'|'grain'|'milk'|'whisky'|'wool', price: int, amount: int} $data
     */
    public function fromArray(array $data): GoodPurchasedEvent
    {
        return new GoodPurchasedEvent(
            Uuid::from($data['event_id']),
            Good::fromString($data['good']),
            Price::from((int) $data['price']),
            (int) $data['amount'],
        );
    }

    /**
     * @return array{good: 'bread'|'cheese'|'grain'|'milk'|'whisky'|'wool', price: int, amount: int}
     */
    public function toArray(Event $event): array
    {
        assert($event instanceof GoodPurchasedEvent);

        return [
            'good'   => $event->good()->asString(),
            'price'  => $event->price()->asInt(),
            'amount' => $event->amount(),
        ];
    }
}
