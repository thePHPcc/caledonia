<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\database\MysqliReadingDatabaseConnection;
use example\framework\event\DatabaseEventReader;
use example\framework\event\EventReader;

trait EventReading
{
    use EventJsonMapper;

    public function createMarketEventSourcer(): MarketEventSourcer
    {
        return new MarketEventSourcer(
            $this->createEventReader(),
        );
    }

    public function createEventReader(): EventReader
    {
        return new DatabaseEventReader(
            $this->createDatabaseConnectionForReadingEvents(),
            $this->createEventJsonMapper(),
        );
    }

    private function createDatabaseConnectionForReadingEvents(): MysqliReadingDatabaseConnection
    {
        return MysqliReadingDatabaseConnection::connect(
            'localhost',
            'event_reader',
            'event_reader_password',
            'caledonia',
        );
    }
}
