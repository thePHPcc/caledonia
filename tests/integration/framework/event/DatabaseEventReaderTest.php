<?php declare(strict_types=1);
namespace example\framework\event;

use function assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

#[CoversClass(DatabaseEventReader::class)]
#[Medium]
final class DatabaseEventReaderTest extends DatabaseTestCase
{
    public function testReadsEventsByTopic(): void
    {
        $this->prepareEvent();

        $events = $this->reader()->topic('the-topic');

        $this->assertCount(1, $events);

        $event = $events->asArray()[0];

        assert($event instanceof DummyEvent);

        $this->assertSame('the-topic', $event->topic());
        $this->assertSame('b5578a2a-3188-470c-a2b7-3a249faed6fb', $event->id()->asString());
        $this->assertSame('value', $event->key());
    }
}
