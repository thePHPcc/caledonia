<?php declare(strict_types=1);
namespace example\framework\event;

/**
 * @no-named-arguments
 */
final readonly class SubscribableEventDispatcher implements EventDispatcher
{
    /**
     * @var list<EventSubscriber>
     */
    private array $subscribers;

    public function __construct(EventSubscriber ...$subscribers)
    {
        $this->subscribers = $subscribers;
    }

    public function dispatch(Event $event): void
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->notify($event);
        }
    }
}
