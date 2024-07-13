<?php declare(strict_types=1);
namespace example\framework\event;

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
        $statement = new WriteEventStatement(
            $event->id()->asString(),
            $event->topic(),
            $this->mapper->toJson($event),
        );

        $statement->execute($this->database);
    }
}
