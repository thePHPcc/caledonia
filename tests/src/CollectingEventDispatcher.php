<?php declare(strict_types=1);
namespace example\framework\event;

final class CollectingEventDispatcher implements EventDispatcher
{
    /**
     * @var list<Event>
     */
    private array $events = [];

    public function dispatch(Event $event): void
    {
        $this->events[] = $event;
    }

    public function events(): EventCollection
    {
        return EventCollection::fromArray($this->events);
    }
}
