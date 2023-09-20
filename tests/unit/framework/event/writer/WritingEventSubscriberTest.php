<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(WritingEventSubscriber::class)]
#[UsesClass(Event::class)]
#[UsesClass(Uuid::class)]
#[Group('framework')]
#[Group('framework/event')]
#[Small]
final class WritingEventSubscriberTest extends TestCase
{
    public function testWritesSubscribedEvents(): void
    {
        $event = $this->event();

        $writer = $this->createMock(EventWriter::class);

        $writer
            ->expects($this->once())
            ->method('write')
            ->with($event);

        $subscriber = new WritingEventSubscriber($writer);

        $subscriber->notify($event);
    }

    private function event(): Event
    {
        return new DummyEvent(
            Uuid::from('9f0fd1e7-46b1-40cd-9665-1b7535e187c8'),
            'value',
        );
    }
}
