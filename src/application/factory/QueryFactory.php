<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\database\MysqlDatabase;
use example\framework\database\MysqlDatabaseConfiguration;
use example\framework\event\DatabaseEventReader;
use example\framework\event\EventReader;

final readonly class QueryFactory
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

    public function createMarketHtmlProjectionReader(): MarketHtmlProjectionReader
    {
        return new MarketHtmlProjectionReader;
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
}
