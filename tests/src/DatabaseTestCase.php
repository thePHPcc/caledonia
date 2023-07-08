<?php declare(strict_types=1);
namespace example\framework\database;

use PHPUnit\Framework\TestCase;

abstract class DatabaseTestCase extends TestCase
{
    final protected function connectionForReadingEvents(): MysqlDatabase
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

    final protected function connectionForWritingEvents(): MysqlDatabase
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

    final protected function connectionForTesting(): MysqlDatabase
    {
        return MysqlDatabase::connect(
            new MysqlDatabaseConfiguration(
                'localhost',
                'test_fixture_manager',
                'test_fixture_manager_password',
                'caledonia',
            ),
        );
    }

    final protected function emptyTable(string $table): void
    {
        $this->connectionForTesting()->query('TRUNCATE TABLE ' . $table . ';');
    }
}
