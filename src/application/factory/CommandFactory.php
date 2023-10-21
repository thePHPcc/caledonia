<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\database\MysqlDatabase;
use example\framework\database\MysqlDatabaseConfiguration;
use example\framework\event\DatabaseEventReader;
use example\framework\event\DatabaseEventWriter;
use example\framework\event\EventReader;
use example\framework\event\EventWriter;
use example\framework\event\SubscribableEventDispatcher;
use example\framework\event\WritingEventSubscriber;
use example\framework\library\RandomUuidGenerator;

final readonly class CommandFactory
{
    use EventJsonMapper;

    public function createPurchaseGoodCommandProcessor(): PurchaseGoodCommandProcessor
    {
        return new PurchaseGoodCommandProcessor(
            $this->createEventEmitter(),
            $this->createMarketEventSourcer(),
        );
    }

    public function createMarketEventSourcer(): MarketEventSourcer
    {
        return new MarketEventSourcer(
            $this->createEventReader(),
        );
    }

    public function createEventEmitter(): EventEmitter
    {
        return new DispatchingEventEmitter(
            new SubscribableEventDispatcher(
                new WritingEventSubscriber($this->createEventWriter()),
            ),
            new RandomUuidGenerator,
        );
    }

    public function createEventReader(): EventReader
    {
        return new DatabaseEventReader(
            $this->createDatabaseConnectionForReadingEvents(),
            $this->createEventJsonMapper(),
        );
    }

    private function createEventWriter(): EventWriter
    {
        return new DatabaseEventWriter(
            $this->createDatabaseConnectionForWritingEvents(),
            $this->createEventJsonMapper(),
        );
    }

    private function createDatabaseConnectionForReadingEvents(): MysqlDatabase
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
