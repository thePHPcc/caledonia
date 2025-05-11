<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\PurchaseGoodCommand as DomainCommand;
use example\framework\http\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PurchaseGoodCommand::class)]
#[UsesClass(DomainCommand::class)]
#[UsesClass(Response::class)]
#[Small]
#[TestDox('PurchaseGoodCommand')]
final class PurchaseGoodCommandTest extends TestCase
{
    #[TestDox('Delegates to PurchaseGoodCommandProcessor and returns empty response')]
    public function testDelegatesToPurchaseGoodCommandProcessorAndReturnsEmptyResponse(): void
    {
        $domainCommand = new DomainCommand(Good::Bread, 1);

        $processor = $this->createMock(PurchaseGoodCommandProcessor::class);

        $processor
            ->expects($this->once())
            ->method('process')
            ->with($domainCommand);

        $command = new PurchaseGoodCommand(
            $processor,
            $domainCommand,
        );

        $response = $command->execute();

        $this->assertSame('', $response->body());
    }
}
