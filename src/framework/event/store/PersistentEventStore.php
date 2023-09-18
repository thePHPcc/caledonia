<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;

final readonly class PersistentEventStore implements EventStore
{
    private EventReader $reader;
    private EventWriter $writer;

    public function __construct(EventReader $reader, EventWriter $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    public function add(Event $event): void
    {
        $this->writer->write($event);
    }

    public function correlation(Uuid $correlationId): EventCollection
    {
        return $this->reader->correlation($correlationId);
    }

    public function topic(string $topic): EventCollection
    {
        return $this->reader->topic($topic);
    }
}
