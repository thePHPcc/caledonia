<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\database\Database;

final readonly class DatabaseEventWriter implements EventWriter
{
    private Database $database;
    private EventJsonMapper $mapper;

    public function __construct(Database $database, EventJsonMapper $mapper)
    {
        $this->database = $database;
        $this->mapper   = $mapper;
    }

    public function write(Event $event): void
    {
    }
}
