<?php declare(strict_types=1);
namespace example\framework\event;

use function assert;
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
#[UsesClass(Uuid::class)]
#[Group('framework')]
#[Group('framework/event')]
#[Small]
final class EventJsonMapperTest extends TestCase
{
    public function testMapsEventObjectToJsonDocument(): void
    {
        $this->assertJsonStringEqualsJsonFile(
            __DIR__ . '/../../_fixture/dummy-event.json',
            $this->mapper()->toJson($this->event()),
        );
    }

    public function testMapsJsonDocumentToEventObject(): void
    {
        $json = file_get_contents(__DIR__ . '/../../_fixture/dummy-event.json');

        assert($json !== false);
        assert($json !== '');

        $event = $this->mapper()->fromJson($json);

        $this->assertInstanceOf(DummyEvent::class, $event);

        $this->assertSame($this->event()->topic(), $event->topic());
        $this->assertSame($this->event()->id()->asString(), $event->id()->asString());
        $this->assertSame($this->event()->key(), $event->key());
    }

    public function testCannotMapUnknownEventToJson(): void
    {
        $this->expectException(CannotMapEventException::class);

        (new EventJsonMapper([]))->toJson($this->event());
    }

    public function testCannotMapFromJsonWithUnknownEvent(): void
    {
        $json = json_encode([]);

        assert($json !== false);

        $this->expectException(CannotMapEventException::class);

        (new EventJsonMapper([]))->fromJson($json);
    }

    public function testCannotMapFromJsonWithUnknownEvent2(): void
    {
        $json = json_encode(['topic' => 'unknown']);

        assert($json !== false);

        $this->expectException(CannotMapEventException::class);

        (new EventJsonMapper([]))->fromJson($json);
    }

    private function event(): DummyEvent
    {
        return new DummyEvent(
            Uuid::from('9f0fd1e7-46b1-40cd-9665-1b7535e187c8'),
            'value',
        );
    }

    private function mapper(): EventJsonMapper
    {
        return new EventJsonMapper(['the-topic' => new DummyEventMapper]);
    }
}
