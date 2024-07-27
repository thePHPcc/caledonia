<?php declare(strict_types=1);
namespace example\framework\event;

/**
 * @no-named-arguments
 */
interface EventDispatcher
{
    public function dispatch(Event $event): void;
}
