<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(InMemoryEventStore::class)]
#[UsesClass(EventCollection::class)]
#[UsesClass(CorrelatedEvent::class)]
#[UsesClass(Event::class)]
#[UsesClass(Uuid::class)]
#[Group('framework')]
#[Group('framework/event')]
#[Small]
final class InMemoryEventStoreTest extends TestCase
{
    public function testIsInitiallyEmpty(): void
    {
        $store = new InMemoryEventStore;

        $this->assertEmpty($store->correlation(Uuid::from('14766ee9-6ddc-4377-aaf6-0be2d59f8288')));
        $this->assertEmpty($store->topic('the-topic'));
    }

    public function testStoresEvent(): void
    {
        $event = new AnotherDummyEvent(
            new Uuid('0d5c2a07-6ee5-4aae-950e-3e93399e364d'),
            'value',
        );

        $store = new InMemoryEventStore;

        $store->add($event);

        $this->assertSame([$event], $store->topic('the-topic')->asArray());
    }

    public function testStoresCorrelatedEvent(): void
    {
        $correlationId = new Uuid('e05e73ab-83e4-44ed-a533-c219d4ea4c77');

        $event = new DummyEvent(
            new Uuid('017194ca-dcc1-417e-b5df-a0bd9b9d3dd3'),
            $correlationId,
            'value',
        );

        $store = new InMemoryEventStore;

        $store->add($event);

        $this->assertSame([$event], $store->topic('the-topic')->asArray());
        $this->assertSame([$event], $store->correlation($correlationId)->asArray());
    }
}
