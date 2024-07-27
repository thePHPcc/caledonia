<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(Good::class)]
#[Group('domain')]
#[Small]
final class GoodTest extends TestCase
{
    public function testCanBeCreatedFromString(): void
    {
        $this->assertSame(Good::Bread, Good::fromString('bread'));
        $this->assertSame(Good::Cheese, Good::fromString('cheese'));
        $this->assertSame(Good::Grain, Good::fromString('grain'));
        $this->assertSame(Good::Milk, Good::fromString('milk'));
        $this->assertSame(Good::Whisky, Good::fromString('whisky'));
        $this->assertSame(Good::Wool, Good::fromString('wool'));
    }
}
