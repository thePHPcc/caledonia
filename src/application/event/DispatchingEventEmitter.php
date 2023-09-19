<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\event\EventDispatcher;

final readonly class DispatchingEventEmitter implements EventEmitter
{
    private EventDispatcher $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
}
