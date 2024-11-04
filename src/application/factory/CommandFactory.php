<?php declare(strict_types=1);
namespace example\caledonia\application;

/**
 * @no-named-arguments
 */
interface CommandFactory
{
    public function createPurchaseGoodCommandProcessor(): PurchaseGoodCommandProcessor;

    public function createSellGoodCommandProcessor(): SellGoodCommandProcessor;
}
