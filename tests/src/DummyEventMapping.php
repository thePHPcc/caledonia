<?php declare(strict_types=1);
namespace example\framework\event;

use function assert;
use example\framework\library\Uuid;

final readonly class DummyEventMapping implements EventArrayMapper
{
    public function fromArray(array $data): DummyEvent
    {
        assert(isset($data['key']));
        assert(isset($data['event_id']));
        assert(isset($data['correlation_id']));

        return new DummyEvent(Uuid::from($data['event_id']), Uuid::from($data['correlation_id']), $data['key']);
    }

    public function toArray(Event $event): array
    {
        assert($event instanceof DummyEvent);

        return [
            'key' => $event->key(),
        ];
    }
}
