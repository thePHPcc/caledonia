<?php declare(strict_types=1);
namespace example\framework;

use example\framework\database\MysqlDatabase;
use example\framework\database\MysqlDatabaseConfiguration;
use example\framework\event\DatabaseEventReader;
use example\framework\event\DatabaseEventWriter;
use example\framework\event\EventDispatcher;
use example\framework\event\EventReader;
use example\framework\event\EventWriter;
use example\framework\event\WritingEventDispatcher;

final class Factory
{
    public function eventDispatcher(): EventDispatcher
    {
        return new WritingEventDispatcher($this->eventWriter());
    }

    public function eventReader(): EventReader
    {
        return new DatabaseEventReader($this->eventReaderDatabase());
    }

    public function eventWriter(): EventWriter
    {
        return new DatabaseEventWriter($this->eventWriterDatabase());
    }

    public function eventReaderDatabase(): MysqlDatabase
    {
        return MysqlDatabase::connect(
            new MysqlDatabaseConfiguration(
                'localhost',
                'event_reader',
                'event_reader_password',
                'caledonia',
            ),
        );
    }

    public function eventWriterDatabase(): MysqlDatabase
    {
        return MysqlDatabase::connect(
            new MysqlDatabaseConfiguration(
                'localhost',
                'event_writer',
                'event_writer_password',
                'caledonia',
            ),
        );
    }
}
