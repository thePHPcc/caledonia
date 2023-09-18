<?php declare(strict_types=1);
namespace example\framework\event;

use function assert;
use example\framework\library\Uuid;

final class InMemoryEventStore implements EventStore
{
    /**
     * @psalm-var array<non-empty-string, list<Event>>
     */
    private array $eventsByTopic = [];

    /**
     * @psalm-var array<non-empty-string, list<Event>>
     */
    private array $eventsByCorrelationId = [];

    public function add(Event $event): void
    {
        if (!isset($this->eventsByTopic[$event->topic()])) {
            $this->eventsByTopic[$event->topic()] = [];
        }

        $this->eventsByTopic[$event->topic()][] = $event;

        if (!$event->hasCorrelationId()) {
            return;
        }

        /** @psalm-suppress RedundantCondition */
        assert($event instanceof CorrelatedEvent);

        if (!isset($this->eventsByCorrelationId[$event->correlationId()->asString()])) {
            $this->eventsByCorrelationId[$event->correlationId()->asString()] = [];
        }

        $this->eventsByCorrelationId[$event->correlationId()->asString()][] = $event;
    }

    public function correlation(Uuid $correlationId): EventCollection
    {
        if (!isset($this->eventsByCorrelationId[$correlationId->asString()])) {
            return EventCollection::fromArray([]);
        }

        return EventCollection::fromArray($this->eventsByCorrelationId[$correlationId->asString()]);
    }

    public function topic(string $topic): EventCollection
    {
        if (!isset($this->eventsByTopic[$topic])) {
            return EventCollection::fromArray([]);
        }

        return EventCollection::fromArray($this->eventsByTopic[$topic]);
    }
}
