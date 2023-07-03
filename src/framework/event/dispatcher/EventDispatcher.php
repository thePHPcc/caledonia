<?php declare(strict_types=1);
namespace example\framework\event;

interface EventDispatcher
{
    public function dispatch(Event $event): void;
}
