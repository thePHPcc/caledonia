<?php declare(strict_types=1);
namespace example\framework\event;

use function assert;
use SebastianBergmann\MysqliWrapper\ReadingDatabaseConnection;

/**
 * @no-named-arguments
 */
final readonly class DatabaseEventReader implements EventReader
{
    private ReadingDatabaseConnection $connection;
    private EventJsonMapper $mapper;

    public function __construct(ReadingDatabaseConnection $connection, EventJsonMapper $mapper)
    {
        $this->connection = $connection;
        $this->mapper     = $mapper;
    }

    /**
     * @param non-empty-string ...$topics
     */
    public function topic(string ...$topics): EventCollection
    {
        assert($topics !== []);

        $result = new ReadEventsStatement($topics)->execute($this->connection);
        $events = [];

        foreach ($result as $row) {
            $events[] = $this->mapper->fromJson($row['payload']);
        }

        return EventCollection::fromArray($events);
    }
}
