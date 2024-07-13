<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;

final readonly class DummyEvent extends Event
{
    /**
     * @var non-empty-string
     */
    private string $key;

    /**
     * @param non-empty-string $key
     */
    public function __construct(Uuid $id, string $key)
    {
        parent::__construct($id);

        $this->key = $key;
    }

    /**
     * @return non-empty-string
     */
    public function topic(): string
    {
        return 'the-topic';
    }

    /**
     * @return non-empty-string
     */
    public function asString(): string
    {
        return 'another dummy event';
    }

    /**
     * @return non-empty-string
     */
    public function key(): string
    {
        return $this->key;
    }
}
