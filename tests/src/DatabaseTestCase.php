<?php declare(strict_types=1);
namespace example\framework\database;

use function array_keys;
use function count;
use function implode;
use function iterator_to_array;
use function sprintf;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\CsvParser\Parser as CsvParser;
use SebastianBergmann\CsvParser\Schema as CsvSchema;
use Throwable;

abstract class DatabaseTestCase extends TestCase
{
    /**
     * @param non-empty-string $path
     * @param non-empty-string $tableName
     */
    final protected function assertTableEqualsCsvFile(string $path, string $tableName, CsvSchema $schema): void
    {
        $this->assertTableEqualsArray(
            iterator_to_array($this->csvParser()->parse($path, $schema)),
            $tableName,
        );
    }

    /**
     * @param list<array<string, float|int|string>> $expected
     * @param non-empty-string                      $tableName
     */
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

    /**
     * @param non-negative-int $expected
     * @param non-empty-string $tableName
     */
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

    /**
     * @param list<array<string, float|int|string>> $expected
     * @param non-empty-string                      $query
     */
    final protected function assertQuery(array $expected, string $query, string ...$parameters): void
    {
        $this->assertSame($expected, $this->connectionForTesting()->query($query, ...$parameters));
    }

    final protected function connectionForReadingEvents(): MysqlDatabase
    {
        return $this->connect(
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
        return $this->connect(
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
        return $this->connect(
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
        $this->connectionForTesting()->execute('TRUNCATE TABLE ' . $table . ';');
    }

    private function connect(MysqlDatabaseConfiguration $configuration): MysqlDatabase
    {
        try {
            return MysqlDatabase::connect($configuration);
        } catch (Throwable) {
            $this->markTestSkipped('Could not connect to test database');
        }
    }

    private function csvParser(): CsvParser
    {
        $parser = new CsvParser;

        $parser->ignoreFirstLine();
        $parser->setSeparator(';');

        return $parser;
    }
}
