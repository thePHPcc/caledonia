<?php declare(strict_types=1);
namespace example\framework\event;

/**
 * @no-named-arguments
 */
interface EventWriter
{
    public function write(Event $event): void;
}
