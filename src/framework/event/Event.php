<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;

abstract readonly class Event
{
    private Uuid $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    final public function id(): Uuid
    {
        return $this->id;
    }

    /**
     * @psalm-assert-if-true CorrelatedEvent $this
     */
    public function hasCorrelationId(): bool
    {
        return false;
    }

    /**
     * @psalm-return non-empty-string
     */
    abstract public function topic(): string;
}
