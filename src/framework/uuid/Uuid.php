<?php declare(strict_types=1);
namespace example\framework\library;

use function preg_match;

/**
 * @no-named-arguments
 */
final readonly class Uuid
{
    /**
     * @var non-empty-string
     */
    private string $uuid;

    /**
     * @param non-empty-string $uuid
     *
     * @throws InvalidUuidException
     */
    public static function from(string $uuid): self
    {
        return new self($uuid);
    }

    /**
     * @param non-empty-string $uuid
     *
     * @throws InvalidUuidException
     */
    public function __construct(string $uuid)
    {
        $this->ensureIsValidUuid($uuid);

        $this->uuid = $uuid;
    }

    /**
     * @return non-empty-string
     */
    public function asString(): string
    {
        return $this->uuid;
    }

    /**
     * @param non-empty-string $uuid
     *
     * @throws InvalidUuidException
     */
    private function ensureIsValidUuid(string $uuid): void
    {
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid)) {
            throw new InvalidUuidException;
        }
    }
}
