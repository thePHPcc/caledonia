<?php declare(strict_types=1);
namespace example\framework\event;

/**
 * @no-named-arguments
 */
interface EventArrayMapper
{
    /**
     * @param array<string, string> $data
     */
    public function fromArray(array $data): Event;

    /**
     * @return array<string, string>
     */
    public function toArray(Event $event): array;
}
