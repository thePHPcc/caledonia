<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\database\MysqlDatabase;

final readonly class MysqlEventWriter implements EventWriter
{
    private MysqlDatabase $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
    }

    public function write(Event $event): void
    {
    }
}
