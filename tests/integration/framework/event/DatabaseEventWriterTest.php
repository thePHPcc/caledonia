<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\database\DatabaseTestCase;
use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

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

        $this->assertTableEqualsArray(
            [
                [
                    'topic'    => 'the-topic',
                    'event_id' => '74383eed-ab07-443e-9782-a29322594145',
                    'payload'  => '{"topic":"the-topic","event_id":"74383eed-ab07-443e-9782-a29322594145","key":"value"}',
                ],
            ],
            'event',
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
}
