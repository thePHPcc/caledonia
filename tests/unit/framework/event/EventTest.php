<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Event::class)]
#[UsesClass(Uuid::class)]
#[Group('framework')]
#[Group('framework/event')]
#[Small]
final class EventTest extends TestCase
{
    public function testHasTopic(): void
    {
        $this->assertSame('the-topic', $this->event()->topic());
    }

    public function testHasId(): void
    {
        $this->assertSame('9f0fd1e7-46b1-40cd-9665-1b7535e187c8', $this->event()->id()->asString());
    }

    public function testHasCorrelationId(): void
    {
        $this->assertSame('53c540a1-4509-4465-b2cb-0e534be0abab', $this->event()->correlationId()->asString());
    }

    public function testCanBeRepresentedAsArray(): void
    {
        $this->assertSame(['key' => 'value'], $this->event()->asArray());
    }

    private function event(): Event
    {
        return new DummyEvent(
            Uuid::from('9f0fd1e7-46b1-40cd-9665-1b7535e187c8'),
            Uuid::from('53c540a1-4509-4465-b2cb-0e534be0abab'),
        );
    }
}
