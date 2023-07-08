<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;

abstract readonly class CorrelatedEvent extends Event
{
    private Uuid $correlationId;

    public function __construct(Uuid $id, Uuid $correlationId)
    {
        parent::__construct($id);

        $this->correlationId = $correlationId;
    }

    /**
     * @psalm-assert-if-true CorrelatedEvent $this
     */
    final public function hasCorrelationId(): bool
    {
        return true;
    }

    final public function correlationId(): Uuid
    {
        return $this->correlationId;
    }
}
