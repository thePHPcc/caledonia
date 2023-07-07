<?php declare(strict_types=1);
namespace example\framework\event;

use const JSON_PRETTY_PRINT;
use const JSON_THROW_ON_ERROR;
use function array_merge;
use function json_decode;
use function json_encode;

final class EventJsonMapper
{
    /**
     * @psalm-var array<string, EventArrayMapper>
     */
    private array $mappers;

    /**
     * @psalm-param array<string, EventArrayMapper> $mappers
     */
    public function __construct(array $mappers)
    {
        $this->mappers = $mappers;
    }

    /**
     * @throws CannotMapEventException
     */
    public function fromJson(string $topic, string $json): Event
    {
        $this->ensureEventCanBeMapped($topic);

        return $this->mappers[$topic]->fromArray(
            json_decode($json, true, JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws CannotMapEventException
     */
    public function toJson(Event $event): string
    {
        $this->ensureEventCanBeMapped($event->topic());

        $data = array_merge(
            [
                'id'             => $event->id()->asString(),
                'correlation_id' => $event->correlationId()->asString(),
            ],
            $this->mappers[$event->topic()]->toArray($event),
        );

        return json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
    }

    /**
     * @throws CannotMapEventException
     */
    private function ensureEventCanBeMapped(string $topic): void
    {
        if (!isset($this->mappers[$topic])) {
            throw new CannotMapEventException;
        }
    }
}
