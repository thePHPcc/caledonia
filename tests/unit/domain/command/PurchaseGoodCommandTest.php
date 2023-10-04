<?php declare(strict_types=1);
namespace example\caledonia\domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(PurchaseGoodCommand::class)]
#[CoversClass(Bread::class)]
#[CoversClass(Good::class)]
#[Group('domain')]
#[Small]
final class PurchaseGoodCommandTest extends TestCase
{
    public function testHasGood(): void
    {
        $command = new PurchaseGoodCommand(Good::bread(), 1);

        $this->assertTrue($command->good()->isBread());
    }

    public function testHasAmount(): void
    {
        $command = new PurchaseGoodCommand(Good::bread(), 1);

        $this->assertSame(1, $command->amount());
    }
}
