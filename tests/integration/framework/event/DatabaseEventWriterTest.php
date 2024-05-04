<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\database\DatabaseTestCase;
use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use SebastianBergmann\CsvParser\FieldDefinition as CsvFieldDefinition;
use SebastianBergmann\CsvParser\Schema as CsvSchema;
use SebastianBergmann\CsvParser\Type as CsvFieldType;

#[CoversClass(DatabaseEventWriter::class)]
#[Medium]
final class DatabaseEventWriterTest extends DatabaseTestCase
{
    protected function setUp(): void
    {
        $this->emptyTable('event');
    }

    public function testWritesEventToDatabase(): void
    {
        $this->writer()->write($this->event());

        $this->assertTableEqualsCsvFile(
            __DIR__ . '/../../../expectation/event.csv',
            'event',
            $this->eventSchema(),
        );
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
