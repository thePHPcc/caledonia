<?php declare(strict_types=1);
namespace example\framework\database;

use example\framework\Factory;
use PHPUnit\Framework\TestCase;

abstract class DatabaseTestCase extends TestCase
{
    protected function connectionForReadingEvents(): MysqlDatabase
    {
        return (new Factory)->eventReaderDatabase();
    }

    protected function connectionForWritingEvents(): MysqlDatabase
    {
        return (new Factory)->eventWriterDatabase();
    }

    protected function connectionForTesting(): MysqlDatabase
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

    protected function emptyTable(string $table): void
    {
        $this->connectionForTesting()->query('TRUNCATE TABLE ' . $table . ';');
    }
}
