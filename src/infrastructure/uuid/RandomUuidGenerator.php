<?php declare(strict_types=1);
namespace example\caledonia\uuid;

use function bin2hex;
use function hexdec;
use function random_bytes;
use function sprintf;
use function substr;

final readonly class RandomUuidGenerator implements UuidGenerator
{
    public function generate(): Uuid
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $bytes = bin2hex(random_bytes(16));

        return Uuid::from(
            sprintf(
                '%08s-%04s-4%03s-%04x-%012s',
                substr($bytes, 0, 8),
                substr($bytes, 8, 4),
                substr($bytes, 13, 3),
                hexdec(substr($bytes, 16, 4)) & 0x3FFF | 0x8000,
                substr($bytes, 20, 12),
            ),
        );
    }
}
