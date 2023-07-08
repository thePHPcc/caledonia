<?php declare(strict_types=1);
namespace example\framework\database;

use function array_keys;
use function count;
use function implode;
use function sprintf;
use PHPUnit\Framework\TestCase;

abstract class DatabaseTestCase extends TestCase
{
    final protected function assertTableEqualsArray(array $expected, string $tableName): void
    {
        $this->assertNumberOfRowsInTable(count($expected), $tableName);

        $this->assertQuery(
            $expected,
            sprintf(
                'SELECT %s FROM %s;',
                implode(', ', array_keys($expected[0])),
                $tableName,
            ),
        );
    }

    final protected function assertNumberOfRowsInTable(int $expected, string $tableName): void
    {
        $result = $this->connectionForTesting()->query(
            sprintf(
                'SELECT COUNT(*) AS count FROM %s;',
                $tableName,
            ),
        );

        $this->assertSame($expected, $result[0]['count']);
    }

    final protected function assertQuery(array $expected, string $query, string ...$parameters): void
    {
        $this->assertSame($expected, $this->connectionForTesting()->query($query, ...$parameters));
    }

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
