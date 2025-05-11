<?php declare(strict_types=1);
namespace example\caledonia\application;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(FilesystemMarketHtmlProjectionReader::class)]
#[Small]
final class FilesystemMarketHtmlProjectionReaderTest extends TestCase
{
    public function testReadsHtmlProjectionOfMarket(): void
    {
        $path = __DIR__ . '/../../../expectation/market.html';

        $this->assertStringEqualsFile(
            $path,
            new FilesystemMarketHtmlProjectionReader($path)->read(),
        );
    }
}
