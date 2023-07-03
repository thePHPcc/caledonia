<?php declare(strict_types=1);
namespace example\framework\event;

interface EventWriter
{
    public function write(Event $event): void;
}
