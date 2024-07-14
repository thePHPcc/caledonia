<?php declare(strict_types=1);
namespace example\framework\event;

use function is_string;
use SebastianBergmann\MysqliWrapper\ReadingDatabaseConnection;

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
     * @param non-empty-list<non-empty-string>|non-empty-string $topics
     */
    public function topic(array|string $topics): EventCollection
    {
        if (is_string($topics)) {
            $topics = [$topics];
        }

        $result = (new ReadEventsStatement($topics))->execute($this->connection);
        $events = [];

        foreach ($result as $row) {
            $events[] = $this->mapper->fromJson($row['payload']);
        }

        return EventCollection::fromArray($events);
    }
}
