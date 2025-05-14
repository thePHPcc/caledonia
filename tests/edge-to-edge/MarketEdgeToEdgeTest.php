<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\http\GetRequest;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
#[Large]
#[TestDox('Edge-to-Edge Tests for /market')]
final class MarketEdgeToEdgeTest extends TestCase
{
    #[TestDox('GET request to /market sends response with HTML projection (tested through Kernel::run()')]
    public function testGetRequestToMarketSendsResponseWithHtmlProjection(): void
    {
        $request = GetRequest::from('/market', []);

        $response = (new ApplicationFactory)->createApplication()->run($request);

        $this->assertStringEqualsFile(
            __DIR__ . '/../../projections/market.html',
            $response->body(),
        );
    }

    #[RunInSeparateProcess]
    #[TestDox('GET request to /market sends response with HTML projection (tested through index.php)')]
    public function testGetRequestToMarketSendsResponseWithHtmlProjectionSlightlyLarger(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI']    = '/market';

        require __DIR__ . '/../../public/index.php';

        $this->assertStringEqualsFile(
            __DIR__ . '/../../projections/market.html',
            $this->getActualOutputForAssertion(),
        );
    }
}
