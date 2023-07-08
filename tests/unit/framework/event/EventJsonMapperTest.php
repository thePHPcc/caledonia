<?php declare(strict_types=1);
namespace example\framework\event;

use function file_get_contents;
use function json_encode;
use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(EventJsonMapper::class)]
#[UsesClass(Event::class)]
#[UsesClass(CorrelatedEvent::class)]
#[UsesClass(Uuid::class)]
#[Group('framework')]
#[Group('framework/event')]
#[Small]
final class EventJsonMapperTest extends TestCase
{
    public function testMapsEventObjectToJsonDocument(): void
    {
        $this->assertJsonStringEqualsJsonFile(
            __DIR__ . '/../_fixture/dummy-event.json',
            $this->mapper()->toJson($this->event()),
        );
    }

    public function testMapsJsonDocumentToEventObject(): void
    {
        $event = $this->mapper()->fromJson(
            file_get_contents(__DIR__ . '/../_fixture/dummy-event.json'),
        );

        $this->assertInstanceOf(DummyEvent::class, $event);

        $this->assertSame($this->event()->topic(), $event->topic());
        $this->assertSame($this->event()->id()->asString(), $event->id()->asString());
        $this->assertSame($this->event()->correlationId()->asString(), $event->correlationId()->asString());
        $this->assertSame($this->event()->key(), $event->key());
    }

    public function testCannotMapUnknownEvents(): void
    {
        $this->expectException(CannotMapEventException::class);

        (new EventJsonMapper([]))->fromJson(json_encode([]));
    }

    private function event(): DummyEvent
    {
        return new DummyEvent(
            Uuid::from('9f0fd1e7-46b1-40cd-9665-1b7535e187c8'),
            Uuid::from('53c540a1-4509-4465-b2cb-0e534be0abab'),
            'value',
        );
    }

    private function mapper(): EventJsonMapper
    {
        return new EventJsonMapper(['the-topic' => new DummyEventMapping]);
    }
}
