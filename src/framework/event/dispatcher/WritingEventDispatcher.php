<?php declare(strict_types=1);
namespace example\framework\event;

final readonly class WritingEventDispatcher implements EventDispatcher
{
    private EventWriter $writer;

    public function __construct(EventWriter $writer)
    {
        $this->writer = $writer;
    }

    public function dispatch(Event $event): void
    {
        $this->writer->write($event);
    }
}
