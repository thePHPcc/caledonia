#!/usr/bin/env php
<?php declare(strict_types=1);
namespace example\caledonia\application;

if (!isset($argv[1])) {
    fwrite(
        STDERR,
        sprintf(
            'Usage: %s <target>' . PHP_EOL,
            $argv[0]
        )
    );

    exit(1);
}

require __DIR__ . '/../vendor/autoload.php';

$sourcer = (new ProductionQueryFactory)->createMarketEventSourcer();

file_put_contents(
    $argv[1],
    (new MarketHtmlProjector)->project($sourcer->source())
);
