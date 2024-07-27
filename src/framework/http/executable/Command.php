<?php declare(strict_types=1);
namespace example\framework\http;

/**
 * @no-named-arguments
 */
interface Command
{
    public function execute(): Response;
}
