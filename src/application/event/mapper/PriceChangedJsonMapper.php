<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
use example\caledonia\domain\Good;
use example\caledonia\domain\Price;
use example\caledonia\domain\PriceChangedEvent;
use example\framework\event\Event;
use example\framework\event\EventArrayMapper;
use example\framework\library\Uuid;

final class PriceChangedJsonMapper implements EventArrayMapper
{
    /**
     * @param array{event_id: non-empty-string, good: 'bread'|'cheese'|'grain'|'milk'|'whisky'|'wool', old_price: positive-int, new_price: positive-int} $data
     */
    public function fromArray(array $data): PriceChangedEvent
    {
        return new PriceChangedEvent(
            Uuid::from($data['event_id']),
            Good::fromString($data['good']),
            Price::from($data['old_price']),
            Price::from($data['new_price']),
        );
    }

    /**
     * @return array{good: 'bread'|'cheese'|'grain'|'milk'|'whisky'|'wool', old_price: positive-int, new_price: positive-int}
     */
    public function toArray(Event $event): array
    {
        assert($event instanceof PriceChangedEvent);

        return [
            'good'      => $event->good()->asString(),
            'old_price' => $event->old()->asInt(),
            'new_price' => $event->new()->asInt(),
        ];
    }
}
