<?php declare(strict_types=1);
namespace example\framework\http;

interface Query
{
    public function execute(): Response;
}
