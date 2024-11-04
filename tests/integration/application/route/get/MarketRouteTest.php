<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\http\GetRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[CoversClass(MarketRoute::class)]
#[Medium]
final class MarketRouteTest extends TestCase
{
    #[TestDox('Routes GET request to /market to MarketQuery')]
    public function testRoutesGetRequestForMarket(): void
    {
        $route = new MarketRoute($this->createStub(QueryFactory::class));

        $query = $route->route(GetRequest::from('/market', []));

        $this->assertInstanceOf(MarketQuery::class, $query);
    }

    #[TestDox('Does not route GET requests to URIs other than /market to MarketQuery')]
    public function testDoesNotRouteGetRequestsForOtherUris(): void
    {
        $route = new MarketRoute($this->createStub(QueryFactory::class));

        $query = $route->route(GetRequest::from('/', []));

        $this->assertFalse($query);
    }
}
