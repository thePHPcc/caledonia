<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\PurchaseGoodCommand;
use example\framework\http\Command;
use example\framework\http\Response;

final readonly class PurchaseCommand implements Command
{
    private PurchaseGoodCommandProcessor $processor;
    private PurchaseGoodCommand $command;

    /**
     * @psalm-param positive-int $amount
     */
    public function __construct(PurchaseGoodCommandProcessor $processor, PurchaseGoodCommand $command)
    {
        $this->processor = $processor;
        $this->command   = $command;
    }

    public function execute(): Response
    {
        $this->processor->process($this->command);

        return new Response;
    }
}
