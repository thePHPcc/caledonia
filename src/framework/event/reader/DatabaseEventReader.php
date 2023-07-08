<?php declare(strict_types=1);
namespace example\framework\event;

use function assert;
use function is_array;
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
     * @throws DatabaseException
     */
    public function topic(string $topic): EventCollection
    {
        $result = $this->database->query(
            'SELECT payload FROM event WHERE topic = ? ORDER BY id;',
            $topic,
        );

        assert(is_array($result));

        $events = [];

        foreach ($result as $row) {
            $events[] = $this->mapper->fromJson($row['payload']);
        }

        return EventCollection::fromArray($events);
    }
}
