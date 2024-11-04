<?php declare(strict_types=1);
namespace example\caledonia\application;

use const JSON_THROW_ON_ERROR;
use function json_encode;
use example\framework\http\PostRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[CoversClass(SellGoodRoute::class)]
#[Medium]
final class SellGoodRouteTest extends TestCase
{
    #[TestDox('Routes POST request to /sell-good to SellCommand')]
    public function testRoutesPostRequestForSellGood(): void
    {
        $route = new SellGoodRoute($this->createStub(CommandFactory::class));

        $command = $route->route(
            PostRequest::from(
                '/sell-good',
                json_encode(
                    [
                        'good'   => 'bread',
                        'amount' => 1,
                    ],
                    JSON_THROW_ON_ERROR,
                ),
            ),
        );

        $this->assertInstanceOf(SellCommand::class, $command);
    }

    #[TestDox('Does not route POST requests to URIs other than /sell-good to SellCommand')]
    public function testDoesNotRoutePostRequestsForOtherUris(): void
    {
        $route = new SellGoodRoute($this->createStub(CommandFactory::class));

        $command = $route->route(PostRequest::from('/', ''));

        $this->assertFalse($command);
    }
}
