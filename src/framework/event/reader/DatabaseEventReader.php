<?php declare(strict_types=1);
namespace example\framework\event;

use function array_fill;
use function assert;
use function count;
use function implode;
use function is_string;
use function sprintf;
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
     * @param list<non-empty-string>|non-empty-string $topics
     *
     * @throws DatabaseException
     */
    public function topic(array|string $topics): EventCollection
    {
        if (is_string($topics)) {
            $topics = [$topics];
        }

        $result = $this->database->query(
            sprintf(
                'SELECT payload FROM event WHERE topic IN (%s) ORDER BY id;',
                implode(', ', array_fill(0, count($topics), '?')),
            ),
            ...$topics,
        );

        $events = [];

        foreach ($result as $row) {
            assert(is_string($row['payload']));
            assert($row['payload'] !== '');

            $events[] = $this->mapper->fromJson($row['payload']);
        }

        return EventCollection::fromArray($events);
    }
}
