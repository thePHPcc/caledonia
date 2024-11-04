<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\PurchaseGoodCommand;

/**
 * @no-named-arguments
 */
interface PurchaseGoodCommandProcessor
{
    public function process(PurchaseGoodCommand $command): void;
}
