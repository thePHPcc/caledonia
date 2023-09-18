<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PersistentEventStore::class)]
#[UsesClass(EventCollection::class)]
#[UsesClass(Event::class)]
#[UsesClass(Uuid::class)]
#[Group('framework')]
#[Group('framework/event')]
#[Small]
final class PersistentEventStoreTest extends TestCase
{
    public function testUsesEventWriterToStoreEvents(): void
    {
        $reader = $this->createStub(EventReader::class);
        $writer = $this->createMock(EventWriter::class);
        $store  = new PersistentEventStore($reader, $writer);

        $event = new AnotherDummyEvent(
            new Uuid('0d5c2a07-6ee5-4aae-950e-3e93399e364d'),
            'value',
        );

        $writer
            ->expects($this->once())
            ->method('write')
            ->with($event);

        $store->add($event);
    }

    public function testUsesEventReaderToQueryEventsByCorrelationId(): void
    {
        $reader = $this->createMock(EventReader::class);
        $writer = $this->createStub(EventWriter::class);
        $store  = new PersistentEventStore($reader, $writer);

        $correlationId = new Uuid('e05e73ab-83e4-44ed-a533-c219d4ea4c77');

        $reader
            ->expects($this->once())
            ->method('correlation')
            ->with($correlationId)
            ->willReturn(EventCollection::empty());

        $store->correlation($correlationId);
    }

    public function testUsesEventReaderToQueryEventsByTopic(): void
    {
        $reader = $this->createMock(EventReader::class);
        $writer = $this->createStub(EventWriter::class);
        $store  = new PersistentEventStore($reader, $writer);

        $topic = 'the-topic';

        $reader
            ->expects($this->once())
            ->method('topic')
            ->with($topic)
            ->willReturn(EventCollection::empty());

        $store->topic($topic);
    }
}
