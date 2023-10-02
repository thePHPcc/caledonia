<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\event\Event;
use example\framework\event\EventSubscriber;

final readonly class MarketHtmlProjectionSubscriber implements EventSubscriber
{
    public function notify(Event $event): void
    {
    }
}
