<?php declare(strict_types=1);
namespace example\framework\event;

use function is_string;
use example\framework\database\Database;
use example\framework\database\DatabaseException;

final readonly class DatabaseEventReader implements EventReader
{
    private Database $database;
    private EventJsonMapper $mapper;

    public function __construct(Database $database, EventJsonMapper $mapper)
    {
        $this->database = $database;
        $this->mapper   = $mapper;
    }

    /**
     * @param non-empty-list<non-empty-string>|non-empty-string $topics
     *
     * @throws DatabaseException
     */
    public function topic(array|string $topics): EventCollection
    {
        if (is_string($topics)) {
            $topics = [$topics];
        }

        $result = (new ReadEventsStatement($topics))->execute($this->database);
        $events = [];

        foreach ($result as $row) {
            $events[] = $this->mapper->fromJson($row['payload']);
        }

        return EventCollection::fromArray($events);
    }
}
