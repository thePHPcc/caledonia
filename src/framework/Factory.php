<?php declare(strict_types=1);
namespace example\framework;

use example\framework\database\MysqlDatabase;
use example\framework\database\MysqlDatabaseConfiguration;

final class Factory
{
    private function eventReaderDatabase(): MysqlDatabase
    {
        return MysqlDatabase::connect(
            new MysqlDatabaseConfiguration(
                'localhost',
                'event_reader',
                'event_reader_password',
                'event',
            ),
        );
    }

    private function eventWriterDatabase(): MysqlDatabase
    {
        return MysqlDatabase::connect(
            new MysqlDatabaseConfiguration(
                'localhost',
                'event_writer',
                'event_writer_password',
                'event',
            ),
        );
    }
}
