<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\event\EventWriter;

final readonly class WritingEventEmitter implements EventEmitter
{
    private EventWriter $writer;

    public function __construct(EventWriter $writer)
    {
        $this->writer = $writer;
    }
}
