<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(SellGoodCommand::class)]
#[CoversClass(Good::class)]
#[Group('domain')]
#[Small]
final class SellGoodCommandTest extends TestCase
{
    public function testHasGood(): void
    {
        $good = Good::Bread;

        $command = new SellGoodCommand($good, 1);

        $this->assertSame($good, $command->good());
    }

    public function testHasAmount(): void
    {
        $command = new SellGoodCommand(Good::Bread, 1);

        $this->assertSame(1, $command->amount());
    }

    public function testCanBeRepresentedAsString(): void
    {
        $command = new SellGoodCommand(Good::Bread, 1);

        $this->assertSame('Sell 1 bread', $command->asString());
    }
}
