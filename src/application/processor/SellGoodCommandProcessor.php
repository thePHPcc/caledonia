<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\SellGoodCommand;

/**
 * @no-named-arguments
 */
interface SellGoodCommandProcessor
{
    public function process(SellGoodCommand $command): void;
}
