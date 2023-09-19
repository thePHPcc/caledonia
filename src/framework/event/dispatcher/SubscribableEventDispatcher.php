<?php declare(strict_types=1);
namespace example\framework\event;

use function array_values;

final readonly class SubscribableEventDispatcher implements EventDispatcher
{
    /**
     * @psalm-var list<EventSubscriber>
     */
    private array $subscribers;

    public function __construct(EventSubscriber ...$subscribers)
    {
        $this->subscribers = array_values($subscribers);
    }

    public function dispatch(Event $event): void
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->notify($event);
        }
    }
}
