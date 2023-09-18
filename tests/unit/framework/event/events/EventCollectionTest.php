<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(EventCollection::class)]
#[CoversClass(EventCollectionIterator::class)]
#[UsesClass(Event::class)]
#[UsesClass(CorrelatedEvent::class)]
#[UsesClass(Uuid::class)]
#[Group('framework')]
#[Group('framework/event')]
#[Small]
final class EventCollectionTest extends TestCase
{
    #[TestDox('Can be created from list of Event objects')]
    public function testCanBeCreatedFromListOfObjects(): void
    {
        $events = $this->events();

        $collection = EventCollection::fromArray($events);

        $this->assertSame($events, $collection->asArray());
    }

    public function testIsCountable(): void
    {
        $this->assertCount(2, $this->collection());
        $this->assertTrue($this->collection()->isNotEmpty());
        $this->assertTrue(EventCollection::empty()->isEmpty());
    }

    public function testIsIterable(): void
    {
        $expectedPosition = 0;

        foreach ($this->collection() as $position => $event) {
            $this->assertSame($expectedPosition++, $position);
            $this->assertInstanceOf(Event::class, $event);
        }
    }

    private function collection(): EventCollection
    {
        return EventCollection::fromArray($this->events());
    }

    private function events(): array
    {
        return [
            new DummyEvent(
                Uuid::from('9f0fd1e7-46b1-40cd-9665-1b7535e187c8'),
                Uuid::from('53c540a1-4509-4465-b2cb-0e534be0abab'),
                'value',
            ),
            new DummyEvent(
                Uuid::from('31314fcc-c716-47b6-9d5c-d2a631d35f1a'),
                Uuid::from('ffa4422c-dd75-4395-acfc-b84f54225e06'),
                'value',
            ),
        ];
    }
}
