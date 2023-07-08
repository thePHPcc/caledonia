<?php declare(strict_types=1);
namespace example\framework\event;

use const JSON_THROW_ON_ERROR;
use function array_merge;
use function assert;
use function is_array;
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
     * @psalm-param non-empty-string $topic
     * @psalm-param non-empty-string $json
     *
     * @throws CannotMapEventException
     */
    public function fromJson(string $topic, string $json): Event
    {
        $this->ensureEventCanBeMapped($topic);

        $data = json_decode($json, true, JSON_THROW_ON_ERROR);

        assert(is_array($data));

        return $this->mappers[$topic]->fromArray($data);
    }

    /**
     * @psalm-return non-empty-string
     *
     * @throws CannotMapEventException
     */
    public function toJson(Event $event): string
    {
        $this->ensureEventCanBeMapped($event->topic());

        $metadata = [
            'topic' => $event->topic(),
            'event_id' => $event->id()->asString(),
        ];

        if ($event->hasCorrelationId()) {
            /** @psalm-suppress RedundantCondition */
            assert($event instanceof CorrelatedEvent);

            $metadata['correlation_id'] = $event->correlationId()->asString();
        }

        $data = array_merge(
            $metadata,
            $this->mappers[$event->topic()]->toArray($event),
        );

        return json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * @psalm-param non-empty-string $topic
     *
     * @throws CannotMapEventException
     */
    private function ensureEventCanBeMapped(string $topic): void
    {
        if (!isset($this->mappers[$topic])) {
            throw new CannotMapEventException;
        }
    }
}
