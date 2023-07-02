<?php declare(strict_types=1);
namespace example\caledonia\event;

use function count;
use Countable;
use IteratorAggregate;

/**
 * @template-implements IteratorAggregate<int, Event>
 *
 * @psalm-immutable
 */
final readonly class EventCollection implements Countable, IteratorAggregate
{
    /**
     * @psalm-var list<Event>
     */
    private array $events;

    /**
     * @psalm-param list<Event> $events
     */
    public static function fromArray(array $events): self
    {
        return new self($events);
    }

    /**
     * @psalm-param list<Event> $events
     */
    private function __construct(array $events)
    {
        $this->events = $events;
    }

    /**
     * @psalm-return list<Event>
     */
    public function asArray(): array
    {
        return $this->events;
    }

    public function count(): int
    {
        return count($this->events);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function isNotEmpty(): bool
    {
        return $this->count() > 0;
    }

    public function getIterator(): EventCollectionIterator
    {
        return new EventCollectionIterator($this);
    }
}
