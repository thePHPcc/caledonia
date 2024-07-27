<?php declare(strict_types=1);
namespace example\framework\event;

/**
 * @no-named-arguments
 */
final readonly class WritingEventSubscriber implements EventSubscriber
{
    private EventWriter $writer;

    public function __construct(EventWriter $writer)
    {
        $this->writer = $writer;
    }

    public function notify(Event $event): void
    {
        $this->writer->write($event);
    }
}
