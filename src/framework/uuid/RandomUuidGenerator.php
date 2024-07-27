<?php declare(strict_types=1);
namespace example\framework\library;

use function SebastianBergmann\Uuid\uuid;

/**
 * @no-named-arguments
 */
final readonly class RandomUuidGenerator implements UuidGenerator
{
    public function generate(): Uuid
    {
        return Uuid::from(uuid());
    }
}
