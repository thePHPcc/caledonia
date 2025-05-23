<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(PurchaseGoodCommand::class)]
#[CoversClass(Good::class)]
#[Group('domain')]
#[Small]
final class PurchaseGoodCommandTest extends TestCase
{
    public function testHasGood(): void
    {
        $good = Good::Bread;

        $command = new PurchaseGoodCommand($good, 1);

        $this->assertSame($good, $command->good());
    }

    public function testHasAmount(): void
    {
        $command = new PurchaseGoodCommand(Good::Bread, 1);

        $this->assertSame(1, $command->amount());
    }

    public function testCanBeRepresentedAsString(): void
    {
        $command = new PurchaseGoodCommand(Good::Bread, 1);

        $this->assertSame('Purchase 1 bread', $command->asString());
    }
}
