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

    public function testWritesCorrelatedEventToDatabase(): void
    {
        $this->writer()->write($this->eventWithCorrelationId());

        $this->assertTableEqualsArray(
            [
                [
                    'topic'          => 'the-topic',
                    'event_id'       => 'b5578a2a-3188-470c-a2b7-3a249faed6fb',
                    'correlation_id' => 'c46f1078-5363-4a35-a48f-27417805503d',
                    'payload'        => '{"topic":"the-topic","event_id":"b5578a2a-3188-470c-a2b7-3a249faed6fb","correlation_id":"c46f1078-5363-4a35-a48f-27417805503d","key":"value"}',
                ],
            ],
            'event',
        );
    }

    public function testWritesUncorrelatedEventToDatabase(): void
    {
        $this->writer()->write($this->eventWithoutCorrelationId());

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
        return new EventJsonMapper(['the-topic' => new DummyEventMapping]);
    }

    private function eventWithCorrelationId(): Event
    {
        return new DummyEvent(
            Uuid::from('b5578a2a-3188-470c-a2b7-3a249faed6fb'),
            Uuid::from('c46f1078-5363-4a35-a48f-27417805503d'),
            'value',
        );
    }

    private function eventWithoutCorrelationId(): Event
    {
        return new AnotherDummyEvent(
            Uuid::from('74383eed-ab07-443e-9782-a29322594145'),
            'value',
        );
    }
}
