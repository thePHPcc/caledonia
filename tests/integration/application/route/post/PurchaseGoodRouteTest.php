<?php declare(strict_types=1);
namespace example\caledonia\application;

use const JSON_THROW_ON_ERROR;
use function json_encode;
use example\framework\http\PostRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[CoversClass(PurchaseGoodRoute::class)]
#[Medium]
final class PurchaseGoodRouteTest extends TestCase
{
    #[TestDox('Routes POST request to /purchase-good to PurchaseCommand')]
    public function testRoutesPostRequestForPurchaseGood(): void
    {
        $route = new PurchaseGoodRoute($this->createStub(CommandFactory::class));

        $command = $route->route(
            PostRequest::from(
                '/purchase-good',
                json_encode(
                    [
                        'good'   => 'bread',
                        'amount' => 1,
                    ],
                    JSON_THROW_ON_ERROR,
                ),
            ),
        );

        $this->assertInstanceOf(PurchaseCommand::class, $command);
    }

    #[TestDox('Does not route POST requests to URIs other than /purchase-good to PurchaseCommand')]
    public function testDoesNotRoutePostRequestsForOtherUris(): void
    {
        $route = new PurchaseGoodRoute($this->createStub(CommandFactory::class));

        $command = $route->route(PostRequest::from('/', ''));

        $this->assertFalse($command);
    }
}
