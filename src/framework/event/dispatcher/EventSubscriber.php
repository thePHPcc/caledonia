<?php declare(strict_types=1);
namespace example\framework\event;

/**
 * @no-named-arguments
 */
interface EventSubscriber
{
    public function notify(Event $event): void;
}
