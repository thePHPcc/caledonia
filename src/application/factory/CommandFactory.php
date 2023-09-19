<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\database\MysqlDatabase;
use example\framework\database\MysqlDatabaseConfiguration;
use example\framework\event\DatabaseEventWriter;
use example\framework\event\EventWriter;
use example\framework\event\SubscribableEventDispatcher;
use example\framework\event\WritingEventSubscriber;

final readonly class CommandFactory
{
    use EventJsonMapper;

    public function createEventEmitter(): EventEmitter
    {
        return new DispatchingEventEmitter(
            new SubscribableEventDispatcher(
                new WritingEventSubscriber($this->createEventWriter()),
            ),
        );
    }

    private function createEventWriter(): EventWriter
    {
        return new DatabaseEventWriter(
            $this->createDatabaseConnectionForWritingEvents(),
            $this->createEventJsonMapper(),
        );
    }

    private function createDatabaseConnectionForWritingEvents(): MysqlDatabase
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
