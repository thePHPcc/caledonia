<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\database\Database;

final readonly class DatabaseEventReader implements EventReader
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }
}
