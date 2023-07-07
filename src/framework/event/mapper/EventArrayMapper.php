<?php declare(strict_types=1);
namespace example\framework\event;

interface EventArrayMapper
{
    public function fromArray(array $data): Event;

    public function toArray(Event $event): array;
}
