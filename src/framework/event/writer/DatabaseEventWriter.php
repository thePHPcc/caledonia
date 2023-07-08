<?php declare(strict_types=1);
namespace example\framework\event;

use function assert;
use example\framework\database\Database;
use example\framework\database\DatabaseException;

final readonly class DatabaseEventWriter implements EventWriter
{
    private Database $database;
    private EventJsonMapper $mapper;

    public function __construct(Database $database, EventJsonMapper $mapper)
    {
        $this->database = $database;
        $this->mapper   = $mapper;
    }

    /**
     * @throws CannotMapEventException
     * @throws DatabaseException
     */
    public function write(Event $event): void
    {
        if ($event->hasCorrelationId()) {
            /** @psalm-suppress RedundantCondition */
            assert($event instanceof CorrelatedEvent);

            $this->database->query(
                'INSERT INTO event
                             (topic, event_id, correlation_id, payload)
                      VALUES (?, ?, ?, ?);',
                $event->topic(),
                $event->id()->asString(),
                $event->correlationId()->asString(),
                $this->mapper->toJson($event),
            );

            return;
        }

        $this->database->query(
            'INSERT INTO event
                             (topic, event_id, payload)
                      VALUES (?, ?, ?);',
            $event->topic(),
            $event->id()->asString(),
            $this->mapper->toJson($event),
        );
    }
}
