<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
use example\caledonia\domain\Good;
use example\caledonia\domain\GoodSoldEvent;
use example\caledonia\domain\Price;
use example\framework\event\Event;
use example\framework\event\EventArrayMapper;
use example\framework\library\Uuid;

final class GoodSoldJsonMapper implements EventArrayMapper
{
    /**
     * @param array{event_id: non-empty-string, good: 'bread'|'cheese'|'grain'|'milk'|'whisky'|'wool', price: positive-int, amount: positive-int} $data
     */
    public function fromArray(array $data): GoodSoldEvent
    {
        return new GoodSoldEvent(
            Uuid::from($data['event_id']),
            Good::fromString($data['good']),
            Price::from((int) $data['price']),
            (int) $data['amount'],
        );
    }

    /**
     * @return array{good: 'bread'|'cheese'|'grain'|'milk'|'whisky'|'wool', price: positive-int, amount: positive-int}
     */
    public function toArray(Event $event): array
    {
        assert($event instanceof GoodSoldEvent);

        return [
            'good'   => $event->good()->asString(),
            'price'  => $event->price()->asInt(),
            'amount' => $event->amount(),
        ];
    }
}
