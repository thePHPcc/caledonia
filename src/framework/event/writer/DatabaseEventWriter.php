<?php declare(strict_types=1);
namespace example\framework\event;

use SebastianBergmann\MysqliWrapper\Exception;
use SebastianBergmann\MysqliWrapper\WritingDatabaseConnection;

final readonly class DatabaseEventWriter implements EventWriter
{
    private WritingDatabaseConnection $connection;
    private EventJsonMapper $mapper;

    public function __construct(WritingDatabaseConnection $connection, EventJsonMapper $mapper)
    {
        $this->connection = $connection;
        $this->mapper     = $mapper;
    }

    /**
     * @throws CannotMapEventException
     * @throws Exception
     */
    public function write(Event $event): void
    {
        $statement = new WriteEventStatement(
            $event->id()->asString(),
            $event->topic(),
            $this->mapper->toJson($event),
        );

        $statement->execute($this->connection);
    }
}
