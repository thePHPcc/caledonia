<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
use function defined;
use function file_get_contents;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
#[RunTestsInSeparateProcesses]
#[Large]
#[TestDox('End-to-End Tests for /market')]
final class MarketEndToEndTest extends TestCase
{
    #[TestDox('GET request to /market sends response with HTML projection')]
    public function testGetRequestToMarketSendsResponseWithHtmlProjection(): void
    {
        $this->assertStringEqualsFile(
            __DIR__ . '/../../projections/market.html',
            $this->request('/market'),
        );
    }

    private function request(string $uri): string
    {
        assert(defined('TEST_WEB_SERVER_BASE_URL'));

        $response = @file_get_contents(TEST_WEB_SERVER_BASE_URL . $uri);

        if ($response === false) {
            $this->markTestSkipped(TEST_WEB_SERVER_BASE_URL . ' is not available');
        }

        return $response;
    }
}
