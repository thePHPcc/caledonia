<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\event\DatabaseEventReader;
use example\framework\event\EventReader;
use SebastianBergmann\MysqliWrapper\MysqliReadingDatabaseConnection;

/**
 * @no-named-arguments
 *
 * @codeCoverageIgnore
 */
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
            '127.0.0.1',
            'event_reader',
            'event_reader_password',
            'caledonia',
        );
    }
}
