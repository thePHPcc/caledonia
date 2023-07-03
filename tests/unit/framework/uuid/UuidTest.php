<?php declare(strict_types=1);
namespace example\framework\library;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(Uuid::class)]
#[Small]
final class UuidTest extends TestCase
{
    public function testCanBeRepresentedAsString(): void
    {
        $uuid = '0bae35cb-a3df-4ae5-a2f0-302d49ecfecf';

        $this->assertSame($uuid, Uuid::from($uuid)->asString());
    }

    public function testCannotBeCreatedFromInvalidString(): void
    {
        $this->expectException(InvalidUuidException::class);

        Uuid::from('string');
    }
}
