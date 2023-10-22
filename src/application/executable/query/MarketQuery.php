<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\http\Query;
use example\framework\http\Response;

final readonly class MarketQuery implements Query
{
    private MarketHtmlProjectionReader $reader;

    public function __construct(MarketHtmlProjectionReader $reader)
    {
        $this->reader = $reader;
    }

    public function execute(): Response
    {
        $response = new Response;

        $response->setBody($this->reader->read());

        return $response;
    }
}
