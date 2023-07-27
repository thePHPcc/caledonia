<?php declare(strict_types=1);
namespace example\framework\event;

use const JSON_THROW_ON_ERROR;
use function array_key_exists;
use function array_merge;
use function assert;
use function is_array;
use function is_string;
use function json_decode;
use function json_encode;
use JsonException;

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
     * @psalm-param non-empty-string $json
     *
     * @throws CannotMapEventException
     */
    public function fromJson(string $json): Event
    {
        $data = json_decode($json, true, JSON_THROW_ON_ERROR);

        $this->ensureJsonCanBeMapped($data);

        assert(is_array($data));
        assert(isset($data['topic']) && is_string($data['topic']));
        assert(isset($data['event_id']) && is_string($data['event_id']));
        assert(array_key_exists('correlation_id', $data));
        assert(is_string($data['correlation_id']) || null === $data['correlation_id']);

        return $this->mappers[$data['topic']]->fromArray($data);
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
            'topic'          => $event->topic(),
            'event_id'       => $event->id()->asString(),
            'correlation_id' => null,
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

        try {
            return json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new CannotMapEventException(
                $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
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

    /**
     * @throws CannotMapEventException
     */
    private function ensureJsonCanBeMapped(mixed $data): void
    {
        if (!is_array($data)) {
            throw new CannotMapEventException;
        }

        if (!array_key_exists('topic', $data) ||
            !is_string($data['topic']) ||
            !array_key_exists('event_id', $data) ||
            !is_string($data['event_id']) ||
            !array_key_exists('correlation_id', $data) ||
            (!is_string($data['correlation_id']) && null !== $data['correlation_id'])) {
            throw new CannotMapEventException;
        }
    }
}
