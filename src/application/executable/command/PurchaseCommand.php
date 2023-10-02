<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\framework\http\Command;
use example\framework\http\Response;

final readonly class PurchaseCommand implements Command
{
    private PurchaseProcessor $processor;
    private Good $good;

    /**
     * @psalm-var positive-int
     */
    private int $amount;

    /**
     * @psalm-param positive-int $amount
     */
    public function __construct(PurchaseProcessor $processor, Good $good, int $amount)
    {
        $this->processor = $processor;
        $this->good      = $good;
        $this->amount    = $amount;
    }

    public function execute(): Response
    {
        $this->processor->process($this->good, $this->amount);
    }
}
