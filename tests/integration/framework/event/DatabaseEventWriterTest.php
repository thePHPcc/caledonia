<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\CsvParser\FieldDefinition as CsvFieldDefinition;
use SebastianBergmann\CsvParser\Schema as CsvSchema;
use SebastianBergmann\CsvParser\Type as CsvFieldType;
use SebastianBergmann\MysqliWrapper\MysqliReadingDatabaseConnection;
use SebastianBergmann\MysqliWrapper\MysqliWritingDatabaseConnection;
use SebastianBergmann\MysqliWrapper\Testing\Testing;
use Throwable;

#[CoversClass(DatabaseEventWriter::class)]
#[Medium]
final class DatabaseEventWriterTest extends TestCase
{
    use Testing;

    public function testWritesEventToDatabase(): void
    {
        $this->emptyTable('event');

        $this->writer()->write($this->event());

        $this->assertTableEqualsCsvFile(
            __DIR__ . '/../../../expectation/event.csv',
            'event',
            $this->eventSchema(),
        );
    }

    protected function connectionForReadingEvents(): MysqliReadingDatabaseConnection
    {
        try {
            return MysqliReadingDatabaseConnection::connect(
                'localhost',
                'event_reader',
                'event_reader_password',
                'caledonia',
            );
        } catch (Throwable) {
            $this->markTestSkipped('Could not connect to test database');
        }
    }

    protected function connectionForWritingEvents(): MysqliWritingDatabaseConnection
    {
        try {
            return MysqliWritingDatabaseConnection::connect(
                'localhost',
                'event_writer',
                'event_writer_password',
                'caledonia',
            );
        } catch (Throwable) {
            $this->markTestSkipped('Could not connect to test database');
        }
    }

    /**
     * @return array{host: non-empty-string, username: non-empty-string, password: non-empty-string, database: non-empty-string}
     */
    protected function configurationForTesting(): array
    {
        return [
            'host'     => 'localhost',
            'username' => 'test_fixture_manager',
            'password' => 'test_fixture_manager_password',
            'database' => 'caledonia',
        ];
    }

    private function writer(): DatabaseEventWriter
    {
        return new DatabaseEventWriter($this->connectionForWritingEvents(), $this->mapper());
    }

    private function mapper(): EventJsonMapper
    {
        return new EventJsonMapper(['the-topic' => new DummyEventMapper]);
    }

    private function event(): Event
    {
        return new DummyEvent(
            Uuid::from('74383eed-ab07-443e-9782-a29322594145'),
            'value',
        );
    }

    private function eventSchema(): CsvSchema
    {
        return CsvSchema::from(
            CsvFieldDefinition::from(1, 'topic', CsvFieldType::string()),
            CsvFieldDefinition::from(2, 'event_id', CsvFieldType::string()),
            CsvFieldDefinition::from(3, 'payload', CsvFieldType::string()),
        );
    }
}
