<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\SellGoodCommand as DomainCommand;
use example\framework\http\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(SellGoodCommand::class)]
#[UsesClass(DomainCommand::class)]
#[UsesClass(Response::class)]
#[Small]
#[TestDox('SellGoodCommand')]
final class SellGoodCommandTest extends TestCase
{
    #[TestDox('Delegates to SellGoodCommandProcessor and returns empty response')]
    public function testDelegatesToSellGoodCommandProcessorAndReturnsEmptyResponse(): void
    {
        $domainCommand = new DomainCommand(Good::Bread, 1);

        $processor = $this->createMock(SellGoodCommandProcessor::class);

        $processor
            ->expects($this->once())
            ->method('process')
            ->with($domainCommand);

        $command = new SellGoodCommand(
            $processor,
            $domainCommand,
        );

        $response = $command->execute();

        $this->assertSame('', $response->body());
    }
}
