<?php declare(strict_types=1);
namespace example\framework\http;

interface Command
{
    public function execute(): Response;
}
