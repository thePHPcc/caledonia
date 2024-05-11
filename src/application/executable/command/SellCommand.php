<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\SellGoodCommand;
use example\framework\http\Command;
use example\framework\http\Response;

final readonly class SellCommand implements Command
{
    private SellGoodCommandProcessor $processor;
    private SellGoodCommand $command;

    public function __construct(SellGoodCommandProcessor $processor, SellGoodCommand $command)
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
